<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Admin_panel.php';

class Suggestions extends Admin_panel
{
    private $upload_config;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('suggestions_model');

        // config upload images
        $this->upload_config = array(
            'upload_path' => FCPATH . join(DIRECTORY_SEPARATOR, array('uploads', 'suggestions')),
            'allowed_types' => 'gif|jpg|png',
            'encrypt_name' => true,
            'max_size' => '1024', // kB
            'max_width' => '1024',
            'max_height' => '768',
        );

    }

    public function index()
    {
        $page = $this->input->get('page', TRUE);
        $search_suggestion = $this->input->get('search_suggestion', TRUE);

        $page = is_numeric($page) ? (int)$page : 1;
        $perpage = 10;

        $search_params = is_string($search_suggestion) && strlen($search_suggestion) > 0 ? array(
            'description' => $search_suggestion,
            'name' => $search_suggestion
        ) : array();
        $suggestions = $this->suggestions_model->find_by_rank($search_params, array(
            'limit' => $perpage,
            'offset' => $perpage * ($page - 1)
        ));

        $this->data = array(
            'page_title' => 'Suggestions',
            // set the flash data error message if there is one
            'message' => (validation_errors()) ? validation_errors() : $this->session->flashdata('message'),
            'suggestions' => $suggestions,
            'pagination' => array(
                'total' => $this->suggestions_model->total($search_params),
                'page' => $page,
                'perpage' => $perpage,
                'href_base' => base_url() . 'index.php/suggestions/index?page='
            ),
            'search_suggestion' => array('value' => $search_suggestion, 'param_name' => 'search_suggestion')
        );
        $this->load->view('suggestions/index', $this->data);
    }

    public function create_suggestion()
    {
        if (!parent::is_admin()) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('suggestions', 'refresh');
        }

        $this->data['page_title'] = 'Create suggestion';

        $this->load->library('upload');
        $this->upload->initialize($this->upload_config);

        $this->form_validation->set_rules('description', 'description', 'trim|required|max_length[2048]');
        $this->form_validation->set_rules('name', 'name', 'trim|required|max_length[256]');
        $this->form_validation->set_rules('score_a', 'score A', 'trim|is_natural');
        $this->form_validation->set_rules('score_i', 'score I', 'trim|is_natural');
        $this->form_validation->set_rules('score_c', 'score C', 'trim|is_natural');
        $this->form_validation->set_rules('score_p', 'score P', 'trim|is_natural');
        $this->form_validation->set_rules('image', 'image file', '');

        if ($this->form_validation->run() === TRUE) {
            $suggestion_data = array(
                'description' => $this->input->post('description'),
                'name' => $this->input->post('name'),
                'score_A' => $this->input->post('score_a'),
                'score_I' => $this->input->post('score_i'),
                'score_C' => $this->input->post('score_c'),
                'score_P' => $this->input->post('score_p'),
                'image' => null
            );
        }

        //$this->upload->do_upload();//upload the file to the above mentioned path
        $result_form = $this->form_validation->run() === TRUE;
        $result_upload = $result_form ? ($this->upload->do_upload('image') || empty($_FILES['image']['name'])) : false;

        if ($result_upload)
            $suggestion_data['image'] = $this->upload->data('file_name');

        $result_create = $result_form && $result_upload ? $this->suggestions_model->create($suggestion_data) : false;

        if ($result_form && $result_upload && $result_create) {

            // redirect them back to the admin page
            $this->session->set_flashdata('message', 'New suggestion was created successfully !');
            redirect("suggestions/index", 'refresh');

        } else {
            // display the create form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message',
                'Error while creating suggestion'));

            $this->data['upload_message'] = $this->upload->display_errors();
            $this->data['upload_max_bytes'] = $this->upload_config['max_size'] * 1000;
            $this->data['upload_max_width'] = $this->upload_config['max_width'];
            $this->data['upload_max_height'] = $this->upload_config['max_height'];
            $this->data['upload_extensions'] = $this->upload_config['allowed_types'];

            $this->data['description'] = array(
                'name' => 'description',
                'id' => 'description',
                'type' => 'text',
                'value' => $this->form_validation->set_value('description'),
            );
            $this->data['name'] = array(
                'name' => 'name',
                'id' => 'name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('name'),
            );
            $this->data['score_a'] = array(
                'name' => 'score_a',
                'id' => 'score_a',
                'type' => 'number',
                'value' => $this->form_validation->set_value('score_a'),
            );
            $this->data['score_i'] = array(
                'name' => 'score_i',
                'id' => 'score_i',
                'type' => 'number',
                'value' => $this->form_validation->set_value('score_i'),
            );
            $this->data['score_c'] = array(
                'name' => 'score_c',
                'id' => 'score_c',
                'type' => 'number',
                'value' => $this->form_validation->set_value('score_c'),
            );
            $this->data['score_p'] = array(
                'name' => 'score_p',
                'id' => 'score_p',
                'type' => 'number',
                'value' => $this->form_validation->set_value('score_p'),
            );
            $this->data['image'] = array(
                'name' => 'image',
                'id' => 'image',
                'type' => 'file',
            );

            $this->load->view('suggestions/create_suggestion', $this->data);
        }
    }

    public function edit_suggestion($suggestion_id)
    {
        if (!parent::is_admin()) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('suggestions', 'refresh');
        }
        if (!is_numeric($suggestion_id)) {
            $this->session->set_flashdata('message', 'Bad parameters error');
            redirect('suggestions', 'refresh');
        }

        $this->data['page_title'] = 'Edit suggestion';

        // fetch data
        $suggestion = $this->suggestions_model->get($suggestion_id);
        $current_image = $suggestion['image'];

        $this->data['suggestion'] = $suggestion;

        $this->load->library('upload');
        $this->upload->initialize($this->upload_config);

        $this->form_validation->set_rules('description', 'description', 'trim|required|max_length[2048]');
        $this->form_validation->set_rules('name', 'name', 'trim|required|max_length[256]');
        $this->form_validation->set_rules('score_a', 'score A', 'trim|is_natural');
        $this->form_validation->set_rules('score_i', 'score I', 'trim|is_natural');
        $this->form_validation->set_rules('score_c', 'score C', 'trim|is_natural');
        $this->form_validation->set_rules('score_p', 'score P', 'trim|is_natural');
        $this->form_validation->set_rules('image', 'image file', '');

        if (isset($_POST) && !empty($_POST) || (isset($_FILES) && !empty($_FILES))) {
            if (isset($_POST) && !empty($_POST) && $this->form_validation->run() === TRUE) {
                $suggestion['description'] = $this->input->post('description');
                $suggestion['name'] = $this->input->post('name');
                $suggestion['score_A'] = $this->input->post('score_a');
                $suggestion['score_I'] = $this->input->post('score_i');
                $suggestion['score_C'] = $this->input->post('score_c');
                $suggestion['score_P'] = $this->input->post('score_p');
            }


            //$this->upload->do_upload();//upload the file to the above mentioned path
            $result_form = $this->form_validation->run() === TRUE;
            $is_file = !empty($_FILES['image']['name']);
            $result_upload = $result_form ? ($this->upload->do_upload('image' )) : false;

            if ($result_upload)
                $suggestion['image'] = $this->upload->data('file_name');

            $result_update = $result_form || ($result_upload && $is_file) ?
                $this->suggestions_model->update($suggestion['id'], $suggestion) : false;

            // unlink old file
            if ($result_upload && $result_update && $is_file) {
                unlink($this->upload_config['upload_path'] . DIRECTORY_SEPARATOR . $current_image);
            }

            if ($result_form && ($result_upload || !$is_file) && $result_update) {

                // redirect them back to the admin page
                $this->session->set_flashdata('message', 'Suggestion was updated successfully !');
                redirect("suggestions/index", 'refresh');

            }
        }

        // display the create form
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message',
            'Error while updating suggestion'));

        $this->data['upload_message'] = $this->upload->display_errors();
        $this->data['upload_max_bytes'] = $this->upload_config['max_size'] * 1000;
        $this->data['upload_max_width'] = $this->upload_config['max_width'];
        $this->data['upload_max_height'] = $this->upload_config['max_height'];
        $this->data['upload_extensions'] = $this->upload_config['allowed_types'];

        $this->data['description'] = array(
            'name' => 'description',
            'id' => 'description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('description', $suggestion['description']),
        );
        $this->data['name'] = array(
            'name' => 'name',
            'id' => 'name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('name', $suggestion['name']),
        );
        $this->data['score_a'] = array(
            'name' => 'score_a',
            'id' => 'score_a',
            'type' => 'number',
            'value' => $this->form_validation->set_value('score_a', $suggestion['score_A']),
        );
        $this->data['score_i'] = array(
            'name' => 'score_i',
            'id' => 'score_i',
            'type' => 'number',
            'value' => $this->form_validation->set_value('score_i', $suggestion['score_I']),
        );
        $this->data['score_c'] = array(
            'name' => 'score_c',
            'id' => 'score_c',
            'type' => 'number',
            'value' => $this->form_validation->set_value('score_c', $suggestion['score_C']),
        );
        $this->data['score_p'] = array(
            'name' => 'score_p',
            'id' => 'score_p',
            'type' => 'number',
            'value' => $this->form_validation->set_value('score_p', $suggestion['score_P']),
        );
        $this->data['image'] = array(
            'name' => 'image',
            'id' => 'image',
            'type' => 'file',
        );
        $this->data['current_image'] = is_string($current_image) && strlen($current_image) > 0 ?
            base_url() . 'uploads/suggestions/' . $current_image : false;

        $this->load->view('suggestions/edit_suggestion', $this->data);
    }

    //@JSON api: json api for dynamic image removing
    public function remove_image($suggestion_id) {
        if (!parent::is_admin()) {
            $status = false;
        } else if (!is_numeric($suggestion_id)) {
            $status = false;
        } else {
            // fetch data
            $suggestion = $this->suggestions_model->get($suggestion_id);
            $image_name = $suggestion['image'];
            if (is_string($image_name) && strlen($image_name) > 0) {
                // update database
                $db_res = $this->suggestions_model->update($suggestion_id, array('image' => null));

                // remove image
                if ($db_res) {
                    $fullpath = $this->upload_config['upload_path'] . DIRECTORY_SEPARATOR . $image_name;
                    unlink($fullpath);
                }
                $status = $db_res;
            }
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'status' => isset($status) ? $status : false,
                'message' => isset($message) ? $message : 'Finished with status: ' . ($status ? 'OK' : 'FAILED')
            )));
    }


    public function remove_suggestion($suggestion_id)
    {
        if (!parent::is_admin()) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('suggestions', 'refresh');
        }
        if (!is_numeric($suggestion_id)) {
            $this->session->set_flashdata('message', 'Bad parameters error');
            redirect('suggestions', 'refresh');
        }

        if ($this->input->post('suggestion_id')) {
            $suggestion = $this->suggestions_model->get($suggestion_id);
            $db_res = $this->suggestions_model->remove($suggestion_id);

            if (parent::is_admin() && $suggestion_id == $this->input->post('suggestion_id') && $db_res) {
                // unlink image file if exist
                if (is_string($suggestion['image']) && strlen($suggestion['image']) > 0) {
                    unlink($this->upload_config['upload_path'] . DIRECTORY_SEPARATOR . $suggestion['image']);
                }

                $this->session->set_flashdata('message', 'Suggestion was removed successfully');
            } else {
                $this->session->set_flashdata('message', 'Error when removing suggestion');
            }
            redirect('suggestions', 'refresh');
        }

        $this->data = array(
            'page_title' => 'Remove suggestion',
            'suggestion' => $this->suggestions_model->get($suggestion_id)
        );

        $this->load->view('suggestions/remove_suggestion', $this->data);
    }
}
