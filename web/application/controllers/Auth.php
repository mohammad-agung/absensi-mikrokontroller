<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Login Page";
            $this->load->view('template/auth-header', $data);
            $this->load->view('auth/login');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        $user = $this->db->get_where('tbl_admin', ['email' => $email])->row_array();

        if ($user) {
            if ($user['is_active'] == 1) {
                if ($password == $user['password']) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('superadmin');
                    } else {
                        redirect('admin');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger mb-3 w-100 text-center" role="alert">Wrong password!</div>');
                    redirect('');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger mb-3 w-100 text-center" role="alert">This email has not been activated!</div>');
                redirect('');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger mb-3 w-100 text-center" role="alert">Email is not registered</div>');
            redirect('');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success mb-3 w-100 text-center" role="alert">You have been logged out!</div>');
        redirect('');
    }
}
