<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Secure_area.php';

class Admin_panel extends Secure_area {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $data = array(
            'page_title' => 'Admin Panel'
        );
		$this->load->view('admin_panel/index', $data);
	}

}
