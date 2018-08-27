<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Admin_panel.php';

class Tags extends Admin_panel
{
    private $upload_config;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('tags_model');
    }

    public function index()
    {
        $page = $this->input->get('page', TRUE);
        $search_tag = $this->input->get('search_tag', TRUE);

        $page = is_numeric($page) ? (int)$page : 1;
        $perpage = 10;

        $search_params = is_string($search_tag) && strlen($search_tag) > 0 ? array(
            'description' => $search_tag,
            'name' => $search_tag
        ) : array();
        $tags = $this->tags_model->find($search_params, array(
            'limit' => $perpage,
            'offset' => $perpage * ($page - 1)
        ));

        $this->data = array(
            'page_title' => 'tags',
            // set the flash data error message if there is one
            'message' => (validation_errors()) ? validation_errors() : $this->session->flashdata('message'),
            'tags' => $tags,
            'pagination' => array(
                'total' => $this->tags_model->total($search_params),
                'page' => $page,
                'perpage' => $perpage,
                'href_base' => base_url() . 'index.php/tags/index?page='
            ),
            'search_tag' => array('value' => $search_tag, 'param_name' => 'search_tag')
        );
        $this->load->view('tags/index', $this->data);
    }

    public function create_tag()
    {
        if (!parent::is_admin()) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('tags', 'refresh');
        }

        $this->data['page_title'] = 'Create tag';

        $this->form_validation->set_rules('description', 'description', 'trim|required|max_length[2048]');
        $this->form_validation->set_rules('name', 'name', 'trim|required|max_length[256]');
        $this->form_validation->set_rules('score_a', 'score A', 'trim|is_natural');
        $this->form_validation->set_rules('score_i', 'score I', 'trim|is_natural');
        $this->form_validation->set_rules('score_c', 'score C', 'trim|is_natural');
        $this->form_validation->set_rules('score_p', 'score P', 'trim|is_natural');

        if ($this->form_validation->run() === TRUE) {
            $tag_data = array(
                'description' => $this->input->post('description'),
                'name' => $this->input->post('name'),
                'score_A' => $this->input->post('score_a'),
                'score_I' => $this->input->post('score_i'),
                'score_C' => $this->input->post('score_c'),
                'score_P' => $this->input->post('score_p'),
            );
        }

        if ($this->form_validation->run() === TRUE && $this->tags_model->create($tag_data)) {

            // redirect them back to the admin page
            $this->session->set_flashdata('message', 'New tag was created successfully !');
            redirect("tags/index", 'refresh');

        } else {
            // display the create form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message',
                'Error while creating tag'));

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

            $this->load->view('tags/create_tag', $this->data);
        }
    }

    public function edit_tag($tag_id)
    {
        if (!parent::is_admin()) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('tags', 'refresh');
        }
        if (!is_numeric($tag_id)) {
            $this->session->set_flashdata('message', 'Bad parameters error');
            redirect('tags', 'refresh');
        }

        $this->data['page_title'] = 'Edit tag';

        // fetch data
        $tag = $this->tags_model->get($tag_id);

        $this->data['tag'] = $tag;

        $this->form_validation->set_rules('description', 'description', 'trim|required|max_length[2048]');
        $this->form_validation->set_rules('name', 'name', 'trim|required|max_length[256]');
        $this->form_validation->set_rules('score_a', 'score A', 'trim|is_natural');
        $this->form_validation->set_rules('score_i', 'score I', 'trim|is_natural');
        $this->form_validation->set_rules('score_c', 'score C', 'trim|is_natural');
        $this->form_validation->set_rules('score_p', 'score P', 'trim|is_natural');

        if (isset($_POST) && !empty($_POST) || (isset($_FILES) && !empty($_FILES))) {
            if (isset($_POST) && !empty($_POST) && $this->form_validation->run() === TRUE) {
                $tag['description'] = $this->input->post('description');
                $tag['name'] = $this->input->post('name');
                $tag['score_A'] = $this->input->post('score_a');
                $tag['score_I'] = $this->input->post('score_i');
                $tag['score_C'] = $this->input->post('score_c');
                $tag['score_P'] = $this->input->post('score_p');
            }

            if ($this->form_validation->run() === TRUE && $this->tags_model->update($tag['id'], $tag)) {

                // redirect them back to the admin page
                $this->session->set_flashdata('message', 'Tag was updated successfully !');
                redirect("tags/index", 'refresh');

            }
        }

        // display the create form
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message',
            'Error while updating tag'));

        $this->data['description'] = array(
            'name' => 'description',
            'id' => 'description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('description', $tag['description']),
        );
        $this->data['name'] = array(
            'name' => 'name',
            'id' => 'name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('name', $tag['name']),
        );
        $this->data['score_a'] = array(
            'name' => 'score_a',
            'id' => 'score_a',
            'type' => 'number',
            'value' => $this->form_validation->set_value('score_a', $tag['score_A']),
        );
        $this->data['score_i'] = array(
            'name' => 'score_i',
            'id' => 'score_i',
            'type' => 'number',
            'value' => $this->form_validation->set_value('score_i', $tag['score_I']),
        );
        $this->data['score_c'] = array(
            'name' => 'score_c',
            'id' => 'score_c',
            'type' => 'number',
            'value' => $this->form_validation->set_value('score_c', $tag['score_C']),
        );
        $this->data['score_p'] = array(
            'name' => 'score_p',
            'id' => 'score_p',
            'type' => 'number',
            'value' => $this->form_validation->set_value('score_p', $tag['score_P']),
        );

        $this->load->view('tags/edit_tag', $this->data);
    }

    public function remove_tag($tag_id)
    {
        if (!parent::is_admin()) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('tags', 'refresh');
        }
        if (!is_numeric($tag_id)) {
            $this->session->set_flashdata('message', 'Bad parameters error');
            redirect('tags', 'refresh');
        }

        if ($this->input->post('tag_id')) {
            $db_res = $this->tags_model->remove($tag_id);

            if (parent::is_admin() && $tag_id == $this->input->post('tag_id') && $db_res) {
                $this->session->set_flashdata('message', 'Tag was removed successfully');
            } else {
                $this->session->set_flashdata('message', 'Error when removing tag');
            }
            redirect('tags', 'refresh');
        }

        $this->data = array(
            'page_title' => 'Remove tag',
            'tag' => $this->tags_model->get($tag_id)
        );

        $this->load->view('tags/remove_tag', $this->data);
    }
}
