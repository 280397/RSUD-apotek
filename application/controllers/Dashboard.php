<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
        check_not_login();
        $data = array(
            'title' => "Ecommerce Dashboard"
        );
        $this->load->view('dashboard', $data);
    }
}
