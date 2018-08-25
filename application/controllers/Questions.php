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
            redirect('questions', 'refresh');
        }

        $this->data['page_title'] = 'Create Question';

        // validate form input
        $answer_idxs = array(1,2,3,4);

        $this->form_validation->set_rules('question', 'question text', 'trim|required|max_length[2048]');
        $this->form_validation->set_rules('group_id', 'group', 'trim|required|max_length[128]');
        foreach ($answer_idxs as $i) {
            $this->form_validation->set_rules('answer' . $i, 'answer 1 text', 'trim');
            $this->form_validation->set_rules('answer' . $i . '_score_a', 'answer ' . $i . ' score A', 'trim|is_natural');
            $this->form_validation->set_rules('answer' . $i . '_score_i', 'answer ' . $i . ' score I', 'trim|is_natural');
            $this->form_validation->set_rules('answer' . $i . '_score_c', 'answer ' . $i . ' score C', 'trim|is_natural');
            $this->form_validation->set_rules('answer' . $i . '_score_p', 'answer ' . $i . ' score P', 'trim|is_natural');
            $this->form_validation->set_rules('answer' . $i . '_next_group', 'answer ' . $i . ' next group', 'trim|max_length[128]');
        }

        if ($this->form_validation->run() === TRUE) {
            $question_data = array(
                'question' => $this->input->post('question'),
                'group_id' => $this->input->post('group_id'),
            );
            $answers_data = array();
            foreach ($answer_idxs as $i) {
                $answer = $this->input->post('answer' . $i);
                $next_group = $this->input->post('answer' . $i . '_next_group');
                if (is_string($answer) && strlen($answer) && is_string($next_group) && strlen($next_group) > 0) {
                    $a_data = array();
                    $a_data['answer'] = $answer;
                    $a_data['score_A'] = $this->input->post('answer' . $i . '_score_a');
                    $a_data['score_I'] = $this->input->post('answer' . $i . '_score_i');
                    $a_data['score_C'] = $this->input->post('answer' . $i . '_score_c');
                    $a_data['score_P'] = $this->input->post('answer' . $i . '_score_p');
                    $a_data['next_question_group_id'] = $next_group;
                    $answers_data[$i] = $a_data;
                } else $answers_data[$i] = false;
            }
        }
        if ($this->form_validation->run() === TRUE && $this->questions_model->create_with_answers($question_data, $answers_data)) {
            // redirect them back to the admin page
            $this->session->set_flashdata('message', 'New question was created successfully !');
            redirect("questions/index", 'refresh');
        } else {
            // display the create form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message',
                'Error while creating question'));

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
            foreach ($answer_idxs as $i) {
                $this->data['answer' . $i] = array(
                    'name' => 'answer' . $i,
                    'id' => 'answer' . $i,
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('answer' . $i),
                );
                $this->data['answer' . $i . '_score_a'] = array(
                    'name' => 'answer' . $i . '_score_a',
                    'id' => 'answer' . $i . '_score_a',
                    'type' => 'number',
                    'value' => $this->form_validation->set_value('answer' . $i . '_score_a'),
                );
                $this->data['answer' . $i . '_score_i'] = array(
                    'name' => 'answer' . $i . '_score_i',
                    'id' => 'answer' . $i . '_score_i',
                    'type' => 'number',
                    'value' => $this->form_validation->set_value('answer' . $i . '_score_i'),
                );
                $this->data['answer' . $i . '_score_c'] = array(
                    'name' => 'answer' . $i . '_score_c',
                    'id' => 'answer' . $i . '_score_c',
                    'type' => 'number',
                    'value' => $this->form_validation->set_value('answer' . $i . '_score_c'),
                );
                $this->data['answer' . $i . '_score_p'] = array(
                    'name' => 'answer' . $i . '_score_p',
                    'id' => 'answer' . $i . '_score_p',
                    'type' => 'number',
                    'value' => $this->form_validation->set_value('answer' . $i . '_score_p'),
                );
                $this->data['answer' . $i . '_next_group'] = array(
                    'name' => 'answer' . $i . '_next_group',
                    'id' => 'answer' . $i . '_next_group',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('answer' . $i . '_next_group'),
                );
            }

            $this->load->view('questions/create_question', $this->data);
        }
    }

    public function edit_question($question_id)
    {
        if (!parent::is_admin()) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('questions', 'refresh');
        }
        if (!is_numeric($question_id)) {
            $this->session->set_flashdata('message', 'Bad parameters error');
            redirect('questions', 'refresh');
        }

        $this->data['page_title'] = 'Edit Question';

        // fetch question data
        $question_answers = $this->questions_model->get_with_answers($question_id);
        $question = $question_answers['question'];
        $answers = $question_answers['answers'];

        $this->data['question_id'] = $question['id'];

        // validate form input
        $answer_idxs = array(1,2,3,4);

        $this->form_validation->set_rules('question', 'question text', 'trim|required|max_length[2048]');
        $this->form_validation->set_rules('group_id', 'group', 'trim|required|max_length[128]');
        foreach ($answer_idxs as $i) {
            $this->form_validation->set_rules('answer' . $i, 'answer 1 text', 'trim');
            $this->form_validation->set_rules('answer' . $i . '_score_a', 'answer ' . $i . ' score A', 'trim|is_natural');
            $this->form_validation->set_rules('answer' . $i . '_score_i', 'answer ' . $i . ' score I', 'trim|is_natural');
            $this->form_validation->set_rules('answer' . $i . '_score_c', 'answer ' . $i . ' score C', 'trim|is_natural');
            $this->form_validation->set_rules('answer' . $i . '_score_p', 'answer ' . $i . ' score P', 'trim|is_natural');
            $this->form_validation->set_rules('answer' . $i . '_next_group', 'answer ' . $i . ' next group', 'trim|max_length[128]');
        }

        if (isset($_POST) && !empty($_POST)) {

            if ($this->form_validation->run() === TRUE) {
                $question['question'] = $this->input->post('question');
                $question['group_id'] = $this->input->post('group_id');

                foreach ($answer_idxs as $i) {
                    $answers[$i]['answer'] = $this->input->post('answer' . $i);
                    $answers[$i]['next_question_group_id'] = $this->input->post('answer' . $i . '_next_group');
                    $answers[$i]['score_A'] = $this->input->post('answer' . $i . '_score_a');
                    $answers[$i]['score_I'] = $this->input->post('answer' . $i . '_score_i');
                    $answers[$i]['score_C'] = $this->input->post('answer' . $i . '_score_c');
                    $answers[$i]['score_P'] = $this->input->post('answer' . $i . '_score_p');
                }
            }
            if ($this->form_validation->run() === TRUE && $this->questions_model->update_with_answers($question, $answers)) {
                // redirect them back to the admin page
                $this->session->set_flashdata('message', 'Question was updated successfully !');
                redirect("questions/index", 'refresh');
            }
        }

        // display the create form
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message',
            'Error while updating question'));

        $this->data['question'] = array(
            'name' => 'question',
            'id' => 'question',
            'type' => 'text',
            'value' => $this->form_validation->set_value('question', $question['question']),
        );
        $this->data['group_id'] = array(
            'name' => 'group_id',
            'id' => 'group_id',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_id', $question['group_id']),
        );
        foreach ($answer_idxs as $i) {
            $this->data['answer' . $i] = array(
                'name' => 'answer' . $i,
                'id' => 'answer' . $i,
                'type' => 'text',
                'value' => $this->form_validation->set_value('answer' . $i, $answers[$i]['answer']),
            );
            $this->data['answer' . $i . '_score_a'] = array(
                'name' => 'answer' . $i . '_score_a',
                'id' => 'answer' . $i . '_score_a',
                'type' => 'number',
                'value' => $this->form_validation->set_value('answer' . $i . '_score_a', $answers[$i]['score_A']),
            );
            $this->data['answer' . $i . '_score_i'] = array(
                'name' => 'answer' . $i . '_score_i',
                'id' => 'answer' . $i . '_score_i',
                'type' => 'number',
                'value' => $this->form_validation->set_value('answer' . $i . '_score_i', $answers[$i]['score_I']),
            );
            $this->data['answer' . $i . '_score_c'] = array(
                'name' => 'answer' . $i . '_score_c',
                'id' => 'answer' . $i . '_score_c',
                'type' => 'number',
                'value' => $this->form_validation->set_value('answer' . $i . '_score_c', $answers[$i]['score_C']),
            );
            $this->data['answer' . $i . '_score_p'] = array(
                'name' => 'answer' . $i . '_score_p',
                'id' => 'answer' . $i . '_score_p',
                'type' => 'number',
                'value' => $this->form_validation->set_value('answer' . $i . '_score_p', $answers[$i]['score_P']),
            );
            $this->data['answer' . $i . '_next_group'] = array(
                'name' => 'answer' . $i . '_next_group',
                'id' => 'answer' . $i . '_next_group',
                'type' => 'text',
                'value' => $this->form_validation->set_value('answer' . $i . '_next_group', $answers[$i]['next_question_group_id']),
            );

        }

        $this->load->view('questions/edit_question', $this->data);
    }


    public function remove_question($question_id = null)
    {
        if (!parent::is_admin()) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('questions', 'refresh');
        }
        if (!is_numeric($question_id)) {
            $this->session->set_flashdata('message', 'Bad parameters error');
            redirect('questions', 'refresh');
        }

        if ($this->input->post('question_id')) {
            if (parent::is_admin() && $question_id == $this->input->post('question_id')) {
                $this->questions_model->remove_with_answers($question_id);
                $this->session->set_flashdata('message', 'Question was removed successfully');
            } else {
                $this->session->set_flashdata('message', 'Error when removing question');
            }
            redirect('questions', 'refresh');
        }

        $this->data = array(
            'page_title' => 'Remove Question',
            'question' => $this->questions_model->get($question_id)
        );

        $this->load->view('questions/remove_question', $this->data);
    }
}
