<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('tbl_role', ['id' => $data['user']['role_id']])->row_array();
        $data['title'] = 'Dashboard';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('superadmin/dashboard', $data);
        $this->load->view('template/footer');
    }
}
