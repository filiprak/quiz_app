<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Secure_area.php';

class Admin_panel extends Secure_area {

	public function index()
	{
        $this->data = array(
            'page_title' => 'Admin Panel',
            'logged_user' => parent::logged_user(),
            'is_admin' => parent::is_admin(),
        );
		$this->load->view('admin_panel/index', $this->data);
	}

}
