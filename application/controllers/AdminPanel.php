<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminPanel extends CI_Controller {

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

    public function users()
    {
        $data = array(
            'page_title' => 'Users'
        );
        $this->load->view('admin_panel/users', $data);
    }

    public function questions()
    {
        $data = array(
            'page_title' => 'Questions'
        );
        $this->load->view('admin_panel/questions', $data);
    }

    public function tags()
    {
        $data = array(
            'page_title' => 'Tags'
        );
        $this->load->view('admin_panel/tags', $data);
    }

    public function scores()
    {
        $data = array(
            'page_title' => 'Scores'
        );
        $this->load->view('admin_panel/scores', $data);
    }
}
