<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Secure_area.php';

class Admin_panel extends Secure_area {

	public function index()
	{
	    $this->load->model('scores_model');
	    $this->load->model('users_model');
	    $this->load->model('questions_model');

        $this->data = array(
            'page_title' => 'Admin Panel',
            'is_admin' => parent::is_admin(),
            'total_questions' => $this->questions_model->total(),
            'total_q_groups' => count($this->questions_model->get_all_groups()),
            'total_users' => $this->users_model->total(),
            'total_scores' => $this->scores_model->total(),
        );
		$this->load->view('admin_panel/index', $this->data);
	}

}
