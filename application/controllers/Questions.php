<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Admin_panel.php';

class Questions extends Admin_panel
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('questions_model');
    }

    public function index()
    {
        $page = $this->input->get('page', TRUE);
        $search_question = $this->input->get('search_question', TRUE);

        $page = is_numeric($page) ? (int)$page : 1;
        $perpage = 10;

        $search_params = is_string($search_question) && strlen($search_question) > 0 ? array(
            'question' => $search_question,
            'group_id' => $search_question
        ) : array();
        $questions = $this->questions_model->find($search_params, array(
            'limit' => $perpage,
            'offset' => $perpage * ($page - 1)
        ));

        $this->data = array(
            'page_title' => 'Questions & Answers',
            // set the flash data error message if there is one
            'message' => (validation_errors()) ? validation_errors() : $this->session->flashdata('message'),
            'questions' => $questions,
            'pagination' => array(
                'total' => $this->questions_model->total($search_params),
                'page' => $page,
                'perpage' => $perpage,
                'href_base' => base_url() . 'index.php/questions/index?page='
            ),
            'search_question' => array('value' => $search_question, 'param_name' => 'search_question')
        );
        $this->load->view('questions/index', $this->data);
    }

    public function create_question()
    {
        if (!parent::is_admin()) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('users', 'refresh');
        }

        $this->data['page_title'] = 'Create Question';

        // validate form input
        $this->form_validation->set_rules('question', 'question text', 'trim|required|max_length[2048]');
        $this->form_validation->set_rules('group_id', 'group', 'trim|required|max_length[128]');

        if ($this->form_validation->run() === TRUE) {
            $question_data = array(
                'question' => $this->input->post('question'),
                'group_id' => $this->input->post('group_id'),
            );
        }
        if ($this->form_validation->run() === TRUE && $this->questions_model->create($question_data)) {
            // redirect them back to the admin page
            $this->session->set_flashdata('message', 'New question was created successfully !');
            redirect("questions/index", 'refresh');
        } else {
            // display the create form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

            $this->data['question'] = array(
                'name' => 'question',
                'id' => 'question',
                'type' => 'text',
                'value' => $this->form_validation->set_value('question'),
            );
            $this->data['group_id'] = array(
                'name' => 'group_id',
                'id' => 'group_id',
                'type' => 'text',
                'value' => $this->form_validation->set_value('group_id'),
            );

            $this->load->view('questions/create_question', $this->data);
        }
    }

    public function edit_user($user_id)
    {
        if (!parent::is_admin() || !is_numeric($user_id)) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('users', 'refresh');
        }

        $user_id = (int)$user_id;

        $this->data = array(
            'page_title' => 'Edit User'
        );

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $user_id))) {
            redirect('auth', 'refresh');
        }

        $user = $this->ion_auth->user($user_id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($user_id)->result();

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'trim|required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'trim|required');
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'trim');

        if (isset($_POST) && !empty($_POST)) {

            // update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() === TRUE) {
                $this->data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'company' => $this->input->post('company'),
                    'phone' => $this->input->post('phone'),
                );

                // update the password if it was posted
                if ($this->input->post('password')) {
                    $this->data['password'] = $this->input->post('password');
                }

                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    // Update the groups user belongs to
                    $groupData = $this->input->post('groups');

                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $user_id);

                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $user_id);
                        }

                    }
                }

                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $this->data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect('users', 'refresh');

                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect('users', 'refresh');
                }

            }
        }

        // display the edit user form
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        );
        $this->data['company'] = array(
            'name' => 'company',
            'id' => 'company',
            'type' => 'text',
            'value' => $this->form_validation->set_value('company', $user->company),
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'value' => $this->form_validation->set_value('phone', $user->phone),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password'
        );

        $this->load->view('users/edit_user', $this->data);
    }

    public function remove_user($user_id = null)
    {
        if (!parent::is_admin() || !is_numeric($user_id)) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('users', 'refresh');
        }

        if ($this->input->post('user_id')) {
            if (parent::is_admin() && $user_id == $this->input->post('user_id') && $user_id != 1) {
                $this->ion_auth->delete_user($user_id);
                $this->session->set_flashdata('message', 'User was removed successfully');
            } else {
                $this->session->set_flashdata('message', 'Error when removing user');
            }
            redirect('users', 'refresh');
        }

        $this->data = array(
            'page_title' => 'Remove User',
            'user' => $this->ion_auth->user((int)$user_id)->row()
        );

        $this->load->view('users/remove_user', $this->data);
    }
}
