<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    private $data;


    public function __construct()
    {
        parent::__construct();
        $this->load->model('scores_model');
        $this->load->model('questions_model');
        $this->load->model('answers_model');
        $this->load->model('tags_model');
        $this->load->model('suggestions_model');
        $this->load->library('form_validation');

        $this->DOB_OPTIONS = array('under 18', '18-29', '30-44', '45-64', '65+');
        $this->GENDER_OPTIONS = array('male', 'female');
    }


	public function index()
	{
        if (isset($_POST) && !empty($_POST)) {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $gender = $this->input->post('gender');
            $gender = is_string($gender) && strlen($gender) > 0 ? $gender : null;
            $dob = $this->input->post('dob');

            $score_data = array(
                'name' => $name,
                'email' => $email,
                'gender' => $gender,
                'dob' => $dob,
                'total_score_A' => 0,
                'total_score_I' => 0,
                'total_score_C' => 0,
                'total_score_P' => 0,
            );

            $this->form_validation->set_rules('name', 'name', 'trim|required|max_length[256]');
            $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|max_length[512]');
            $this->form_validation->set_rules('gender', 'gender', 'trim|max_length[24]');
            $this->form_validation->set_rules('dob', 'age', 'trim|required|max_length[64]');

            if ($this->form_validation->run() === TRUE
            && in_array($dob, $this->DOB_OPTIONS) && (in_array($gender, $this->GENDER_OPTIONS) || !$gender)
            && $score_id = $this->scores_model->create($score_data)) {

                $score_data['id'] = $score_id;
                $this->session->set_userdata($score_data);
                redirect("welcome/start_quiz", 'refresh');

            } else {
                $this->data['message'] = (validation_errors() ? validation_errors() : 'Something went wrong... Please try later');
            }
        }

		$this->load->view('welcome', $this->data);
	}

	public function start_quiz() {
        $userdata = $this->session->get_userdata();

        if (!is_numeric($userdata['id'])) {
            $this->session->sess_destroy();
            redirect("welcome/index", 'refresh');
        }

        $question1 = $this->questions_model->random_question();
        if (is_array($question1)) {
            $with_answers = $this->questions_model->get_with_answers($question1['id']);
        }
        $this->data['question1'] = $question1;
        $this->data['question1_answers'] = $with_answers['answers'];

        $this->scores_model->update($userdata['id'], array(
            'question1_id' => $question1['id']
        ));

        $this->load->view('start_quiz', $this->data);
    }

    //@JSON api
    public function post_answer($quest_nr) {
        $answer_id = $this->input->get('answer_id');

        $userdata = $this->session->get_userdata();

        if (!is_numeric($userdata['id'])) {
            $this->session->sess_destroy();
            $status = false;
            $message = 'Session expired';

        } else if (is_numeric($quest_nr) && is_numeric($answer_id) && $quest_nr > 0 && $quest_nr < 6 && $answer_id > 0) {
            // fetch data
            $user_score = $this->scores_model->get($userdata['id']);
            $question = $this->questions_model->get($user_score['question' . $quest_nr . '_id']);
            $answer = $this->answers_model->get($answer_id);

            $debug = array($user_score, $question, $answer, $user_score);

            if (is_array($user_score) && is_array($question) && is_array($answer)) {

                $update_data = array(
                    'question' . $quest_nr . '_answer_id' => $answer_id,
                    'total_score_A' => $user_score['total_score_A'] + $answer['score_A'],
                    'total_score_I' => $user_score['total_score_I'] + $answer['score_I'],
                    'total_score_C' => $user_score['total_score_C'] + $answer['score_C'],
                    'total_score_P' => $user_score['total_score_P'] + $answer['score_P'],
                );

                $this->scores_model->update($userdata['id'], $update_data);

                // send next random question
                if ($quest_nr < 5) {
                    $excluded_arr = array();
                    for($i = 1; $i <= $quest_nr; $i++) { $excluded_arr[] = $user_score['question' . $i . '_id']; }
                    $next_group = $answer['next_question_group_id'] ? $answer['next_question_group_id'] : null;
                    $next_question = $this->questions_model->random_question($next_group, $excluded_arr);
                    $with_answers = $this->questions_model->get_with_answers($next_question['id']);
                    $next_question['answers'] = $with_answers['answers'];
                    $data = $next_question;

                    $this->scores_model->update($user_score['id'], array(
                        'question' . ($quest_nr + 1) . '_id' => $next_question['id']
                    ));

                } else if ($quest_nr == 5) {
                    // send random 20 tags
                    $data = $this->tags_model->random_tags(20);
                }

                $status = true;

            } else {
                $status = false;
                $message = 'Invalid parameters';
            }

        } else {
            $status = false;
            $message = 'Invalid parameters';
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'status' => isset($status) ? $status : false,
                'message' => isset($message) ? $message : 'Finished with status: ' . ($status ? 'OK' : 'FAILED'),
                'data' => isset($data) ? $data : null,
            )));
    }

    public function post_tags() {

        $userdata = $this->session->get_userdata();
        $user_score = is_numeric($userdata['id']) ? $this->scores_model->get($userdata['id']) : null;

        if (!is_array($user_score) || !is_numeric($user_score['question5_answer_id'])) {
            $this->session->sess_destroy();
            redirect("welcome/index", 'refresh');
        }

        $tags = $this->input->post('tags');
        $tags = explode(',', is_string($tags) ? $tags : "");

        if (count($tags) == 5) {
            $update_data = array(
                'total_score_A' => $user_score['total_score_A'],
                'total_score_I' => $user_score['total_score_I'],
                'total_score_C' => $user_score['total_score_C'],
                'total_score_P' => $user_score['total_score_P'],
            );

            foreach ($tags as $key => $tag_id) {
                $update_data['tag' . ($key + 1) . '_id'] = $tag_id;
                $tag = $this->tags_model->get($tag_id);
                if (is_array($tag)) {
                    $update_data['total_score_A'] = $user_score['total_score_A'] + $tag['score_A'];
                    $update_data['total_score_I'] = $user_score['total_score_I'] + $tag['score_I'];
                    $update_data['total_score_C'] = $user_score['total_score_C'] + $tag['score_C'];
                    $update_data['total_score_P'] = $user_score['total_score_P'] + $tag['score_P'];
                }
            }
            $this->scores_model->update($userdata['id'], $update_data);

            $final_score = array(
                'score_A' => $update_data['total_score_A'] ,
                'score_I' => $update_data['total_score_I'] ,
                'score_C' => $update_data['total_score_C'] ,
                'score_P' => $update_data['total_score_P'] ,
            );

            // load suggestions to show
            $matched = $this->suggestions_model->get_matched_score($final_score);
            $this->data['suggestions'] = $matched;

        } else {
            $this->data['message'] = 'Something went wrong... please try later';
        }

        $this->load->view('show_suggestions', $this->data);
    }

    //@JSON api
    public function rate_suggestion($suggestion_id) {
        $rating = $this->input->get('rating');

        $userdata = $this->session->get_userdata();

        if (!is_numeric($userdata['id'])) {
            $this->session->sess_destroy();
            $status = false;
            $message = 'Session expired';

        } else if (is_numeric($suggestion_id) && is_numeric($rating) && in_array($rating, array(0,1))) {

            $status = $this->suggestions_model->rate($suggestion_id, $userdata['id'], $rating);

        } else {
            $status = false;
            $message = 'Invalid parameters';
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'status' => isset($status) ? $status : false,
                'message' => isset($message) ? $message : 'Finished with status: ' . ($status ? 'OK' : 'FAILED'),
                'data' => isset($data) ? $data : null,
            )));
    }

}
