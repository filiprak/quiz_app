<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Admin_panel.php';

class Scores extends Admin_panel
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('scores_model');
        $this->load->model('questions_model');
        $this->load->model('tags_model');

        $this->DOB_OPTIONS = array('under 18', '18-29', '30-44', '45-64', '65+');
    }

    public function index()
    {
        $page = $this->input->get('page', TRUE);
        $search_score = $this->input->get('search_score', TRUE);

        $page = is_numeric($page) ? (int)$page : 1;
        $perpage = 10;

        $search_params = is_string($search_score) && strlen($search_score) > 0 ? array(
            'description' => $search_score,
            'name' => $search_score
        ) : array();
        $scores = $this->scores_model->find($search_params, array(
            'limit' => $perpage,
            'offset' => $perpage * ($page - 1)
        ));

        $this->data = array(
            'page_title' => 'Scores',
            // set the flash data error message if there is one
            'message' => (validation_errors()) ? validation_errors() : $this->session->flashdata('message'),
            'scores' => $scores,
            'pagination' => array(
                'total' => $this->scores_model->total($search_params),
                'page' => $page,
                'perpage' => $perpage,
                'href_base' => base_url() . 'index.php/scores/index?page='
            ),
            'search_score' => array('value' => $search_score, 'param_name' => 'search_score')
        );
        $this->load->view('scores/index', $this->data);
    }

    public function create_score()
    {
        if (!parent::is_admin()) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('scores', 'refresh');
        }

        $this->data['page_title'] = 'Create score';

        $quest_indexes = array(1, 2, 3, 4, 5);
        $tag_indexes = array(1, 2, 3, 4, 5);

        $this->form_validation->set_rules('email', 'email', 'trim|valid_email|max_length[512]');
        $this->form_validation->set_rules('name', 'name', 'trim|required|max_length[256]');
        $this->form_validation->set_rules('gender', 'gender', 'trim');
        $this->form_validation->set_rules('dob', 'date of birth', 'trim');

        $this->form_validation->set_rules('score_a', 'score A', 'trim|is_natural');
        $this->form_validation->set_rules('score_i', 'score I', 'trim|is_natural');
        $this->form_validation->set_rules('score_c', 'score C', 'trim|is_natural');
        $this->form_validation->set_rules('score_p', 'score P', 'trim|is_natural');

        foreach ($quest_indexes as $i) {
            $this->form_validation->set_rules('question' . $i . '_id', 'question ' . $i, 'trim|is_natural');
            $this->form_validation->set_rules('question' . $i . '_answer_id', 'question ' . $i . ' answer', 'trim|is_natural');
        }
        foreach ($tag_indexes as $i) {
            $this->form_validation->set_rules('tag' . $i . '_id', 'tag ' . $i, 'trim|is_natural');
        }


        if ($this->form_validation->run() === TRUE) {
            $score_data = array(
                'email' => $this->input->post('email'),
                'dob' => $this->input->post('dob'),
                'gender' => $this->input->post('gender'),
                'name' => $this->input->post('name'),
                'total_score_A' => $this->input->post('score_a'),
                'total_score_I' => $this->input->post('score_i'),
                'total_score_C' => $this->input->post('score_c'),
                'total_score_P' => $this->input->post('score_p'),
            );

            foreach ($quest_indexes as $i) {
                $score_data['question' . $i . '_id'] = $this->input->post('question' . $i . '_id');
                $score_data['question' . $i . '_answer_id'] = $this->input->post('question' . $i . '_answer_id');
            }
            foreach ($tag_indexes as $i) {
                $score_data['tag' . $i . '_id'] = $this->input->post('tag' . $i . '_id');
            }
        }

        if ($this->form_validation->run() === TRUE && $this->scores_model->create($score_data)) {

            // redirect them back to the admin page
            $this->session->set_flashdata('message', 'New score was created successfully !');
            redirect("scores/index", 'refresh');

        } else {
            //fetch all questions for selecting
            $questions = $this->questions_model->find(array(), array('limit' => 1000, 'offset' => 0));
            $tags = $this->tags_model->find(array(), array('limit' => 1000, 'offset' => 0));

            $this->data['dob_options'] = $this->DOB_OPTIONS;

            $this->data['questions'] = $questions;
            $this->data['tags'] = $tags;

            // display the create form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message',
                'Error while creating score'));

            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['name'] = array(
                'name' => 'name',
                'id' => 'name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('name'),
            );
            $this->data['gender'] = array(
                'name' => 'gender',
                'id' => 'gender',
                'type' => 'select',
                'value' => $this->form_validation->set_value('gender'),
            );
            $this->data['dob'] = array(
                'name' => 'dob',
                'id' => 'dob',
                'type' => 'select',
                'value' => $this->form_validation->set_value('dob'),
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

            foreach ($quest_indexes as $i) {
                $qname = 'question' . $i . '_id';
                $qaname = 'question' . $i . '_answer_id';

                $this->data[$qname] = array(
                    'name' => $qname,
                    'id' => $qname,
                    'type' => 'select',
                    'value' => $this->form_validation->set_value($qname),
                );
                $this->data[$qaname] = array(
                    'name' => $qaname,
                    'id' => $qaname,
                    'type' => 'select',
                    'value' => $this->form_validation->set_value($qaname),
                );
            }
            foreach ($tag_indexes as $i) {
                $tname = 'tag' . $i . '_id';
                $score_data[$tname] = array(
                    'name' => $tname,
                    'id' => $tname,
                    'type' => 'select',
                    'value' => $this->form_validation->set_value($tname),
                );
            }

            $this->load->view('scores/create_score', $this->data);
        }
    }

    public function edit_score($score_id)
    {
        if (!parent::is_admin()) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('scores', 'refresh');
        }
        if (!is_numeric($score_id)) {
            $this->session->set_flashdata('message', 'Bad parameters error');
            redirect('scores', 'refresh');
        }

        $this->data['page_title'] = 'Edit score';

        // fetch data
        $score = $this->scores_model->get($score_id);

        $this->data['score'] = $score;

        $quest_indexes = array(1, 2, 3, 4, 5);
        $tag_indexes = array(1, 2, 3, 4, 5);

        $this->form_validation->set_rules('email', 'email', 'trim|valid_email|max_length[512]');
        $this->form_validation->set_rules('name', 'name', 'trim|required|max_length[256]');
        $this->form_validation->set_rules('gender', 'gender', 'trim');
        $this->form_validation->set_rules('dob', 'date of birth', 'trim');

        $this->form_validation->set_rules('score_a', 'score A', 'trim|is_natural');
        $this->form_validation->set_rules('score_i', 'score I', 'trim|is_natural');
        $this->form_validation->set_rules('score_c', 'score C', 'trim|is_natural');
        $this->form_validation->set_rules('score_p', 'score P', 'trim|is_natural');

        foreach ($quest_indexes as $i) {
            $this->form_validation->set_rules('question' . $i . '_id', 'question ' . $i, 'trim|is_natural');
            $this->form_validation->set_rules('question' . $i . '_answer_id', 'question ' . $i . ' answer', 'trim|is_natural');
        }
        foreach ($tag_indexes as $i) {
            $this->form_validation->set_rules('tag' . $i . '_id', 'tag ' . $i, 'trim|is_natural');
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $score['email'] = $this->input->post('email');
                $score['dob'] = $this->input->post('dob');
                $score['gender'] = $this->input->post('gender');
                $score['name'] = $this->input->post('name');
                $score['total_score_A'] = $this->input->post('score_a');
                $score['total_score_I'] = $this->input->post('score_i');
                $score['total_score_C'] = $this->input->post('score_c');
                $score['total_score_P'] = $this->input->post('score_p');

                foreach ($quest_indexes as $i) {
                    $score['question' . $i . '_id'] = $this->input->post('question' . $i . '_id');
                    $score['question' . $i . '_answer_id'] = $this->input->post('question' . $i . '_answer_id');
                }
                foreach ($tag_indexes as $i) {
                    $score['tag' . $i . '_id'] = $this->input->post('tag' . $i . '_id');
                }
            }

            if ($this->form_validation->run() === TRUE && $this->scores_model->update($score['id'], $score)) {

                // redirect them back to the admin page
                $this->session->set_flashdata('message', 'Score was updated successfully !');
                redirect("scores/index", 'refresh');

            }
        }

        // display the create form
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message',
            'Error while updating score'));

        //fetch all questions for selecting
        $questions = $this->questions_model->find_select_opts(array(), array('limit' => 1000, 'offset' => 0));
        $tags = $this->tags_model->find_select_opts(array(), array('limit' => 1000, 'offset' => 0));

        $this->data['dob_options'] = $this->DOB_OPTIONS;

        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'text',
            'value' => $this->form_validation->set_value('email', $score['email']),
        );
        $this->data['name'] = array(
            'name' => 'name',
            'id' => 'name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('name', $score['name']),
        );
        $this->data['gender'] = array(
            'name' => 'gender',
            'id' => 'gender',
            'type' => 'select',
            'value' => $this->form_validation->set_value('gender', $score['gender']),
        );
        $this->data['dob'] = array(
            'name' => 'dob',
            'id' => 'dob',
            'type' => 'select',
            'value' => $this->form_validation->set_value('dob', $score['dob']),
        );
        $this->data['score_a'] = array(
            'name' => 'score_a',
            'id' => 'score_a',
            'type' => 'number',
            'value' => $this->form_validation->set_value('score_a', $score['total_score_A']),
        );
        $this->data['score_i'] = array(
            'name' => 'score_i',
            'id' => 'score_i',
            'type' => 'number',
            'value' => $this->form_validation->set_value('score_i', $score['total_score_I']),
        );
        $this->data['score_c'] = array(
            'name' => 'score_c',
            'id' => 'score_c',
            'type' => 'number',
            'value' => $this->form_validation->set_value('score_c', $score['total_score_C']),
        );
        $this->data['score_p'] = array(
            'name' => 'score_p',
            'id' => 'score_p',
            'type' => 'number',
            'value' => $this->form_validation->set_value('score_p', $score['total_score_P']),
        );

        $this->data['question_selects'] = array();
        $this->data['question_ans_selects'] = array();
        $this->data['tag_selects'] = array();

        foreach ($quest_indexes as $i) {
            $qname = 'question' . $i . '_id';
            $qaname = 'question' . $i . '_answer_id';

            $selected_qid = $this->form_validation->set_value($qname, $score[$qname]);

            $this->data['question_selects'][$i] = array(
                'params' => array(
                    'name' => $qname,
                    'id' => $qname,
                    'type' => 'select',
                    'value' => $selected_qid,
                ),
                'options' => $questions
            );
            $this->data['question_ans_selects'][$i] = array(
                'params' => array(
                    'name' => $qname,
                    'id' => $qname,
                    'type' => 'select',
                    'value' => $this->form_validation->set_value($qaname, $score[$qaname]),
                ),
                'options' => $this->questions_model->find_ans_select_opts(
                    $selected_qid, array('limit' => 25, 'offset' => 0)
                )
            );
        }
        foreach ($tag_indexes as $i) {
            $tname = 'tag' . $i . '_id';
            $this->data['tag_selects'][$i] = array(
                'params' => array(
                    'name' => $tname,
                    'id' => $tname,
                    'type' => 'select',
                    'value' => $this->form_validation->set_value($tname, $score[$tname]),
                ),
                'options' => $tags
            );
        }

        $this->load->view('scores/edit_score', $this->data);
    }

    public function remove_score($score_id)
    {
        if (!parent::is_admin()) {
            $this->session->set_flashdata('message', 'You have to be an admin to perform this action');
            redirect('scores', 'refresh');
        }
        if (!is_numeric($score_id)) {
            $this->session->set_flashdata('message', 'Bad parameters error');
            redirect('scores', 'refresh');
        }

        if ($this->input->post('score_id')) {
            $db_res = $this->scores_model->remove($score_id);

            if (parent::is_admin() && $score_id == $this->input->post('score_id') && $db_res) {
                $this->session->set_flashdata('message', 'Score was removed successfully');
            } else {
                $this->session->set_flashdata('message', 'Error when removing score');
            }
            redirect('scores', 'refresh');
        }

        $this->data = array(
            'page_title' => 'Remove score',
            'score' => $this->scores_model->get($score_id)
        );

        $this->load->view('scores/remove_score', $this->data);
    }

    // json api for dynamic answer fetching
    public function question_answers($question_id)
    {
        if (!parent::is_admin()) {
            $status = false;
        } else if (!is_numeric($question_id)) {
            $status = false;
        } else {
            // fetch data
            $answers = $this->questions_model->get_with_answers($question_id);
            $answers = $answers['answers'];
            $status = true;
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'status' => isset($status) ? $status : false,
                'message' => isset($message) ? $message : 'Finished with status: ' . ($status ? 'OK' : 'FAILED'),
                'answers' => is_array($answers) ? $answers : array()
            )));
    }
}
