<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Secure_area extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
    }

    public function is_admin() {
        return $this->ion_auth->is_admin();
    }

    public function in_group($group) {
        return $this->ion_auth->in_group($group);
    }
}