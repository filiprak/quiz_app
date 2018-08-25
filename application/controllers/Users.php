<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Admin_panel.php';

class Users extends Admin_panel
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->config->load('ion_auth');
        $this->lang->load('auth');
        $this->load->model('users_model');
    }

    public function index()
    {
        $page = $this->input->get('page', TRUE);
        $search_users = trim($this->input->get('search_users', TRUE));

        $page = is_numeric($page) ? (int)$page : 1;
        $perpage = 10;

        $search_params = is_string($search_users) && strlen($search_users) > 0 ? array(
            'first_name' => $search_users,
            'last_name' => $search_users,
            'email' => $search_users,
        ) : array();

        $users = $this->users_model->find($search_params, array(
            'limit' => $perpage,
            'offset' => $perpage * ($page - 1)
        ));

        $this->data = array(
            'page_title' => 'Users',
            'logged_user' => parent::logged_user(),
            'is_admin' => parent::is_admin(),
            // set the flash data error message if there is one
            'message' => (validation_errors()) ? validation_errors() : $this->session->flashdata('message'),
            'users' => $users,
            'pagination' => array(
                'total' => $this->users_model->total($search_params),
                'page' => $page,
                'perpage' => $perpage,
                'href_base' => base_url() . 'index.php/users/index?page='
            ),
            'search_users' => array('value' => $search_users, 'param_name' => 'search_users')
        );
        foreach ($this->data['users'] as $k => $user) {
            $user_groups = $this->ion_auth->get_users_groups($user['id'])->result();
            $is_admin = false;
            foreach ($user_groups as $group) {
                if ($group->name == 'admin') {
                    $is_admin = true;
                    break;
                }
            }
            $this->data['users'][$k]['is_admin'] = $is_admin;
        }
        $this->load->view('users/index', $this->data);
    }

    public function create_user()
    {
        if (!parent::is_admin()) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('users', 'refresh');
        }

        $this->data['page_title'] = 'Create User';

        $tables = $this->ion_auth->config->item('tables', 'ion_auth');
        $identity_column = $this->ion_auth->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'trim|required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'trim|required');
        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() === TRUE) {
            $email = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
            );
        }
        if ($this->form_validation->run() === TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data)) {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("users/index", 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->data['identity'] = array(
                'name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['company'] = array(
                'name' => 'company',
                'id' => 'company',
                'type' => 'text',
                'value' => $this->form_validation->set_value('company'),
            );
            $this->data['phone'] = array(
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $this->load->view('users/create_user', $this->data);
        }
    }

    public function edit_user($user_id)
    {
        if (!parent::is_admin()) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('users', 'refresh');
        }
        if (!is_numeric($user_id)) {
            $this->session->set_flashdata('message', 'Bad parameters error');
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
        if (!parent::is_admin()) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('users', 'refresh');
        }
        if (!is_numeric($user_id)) {
            $this->session->set_flashdata('message', 'Bad parameters error');
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
