<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        $data['title'] = 'My Profile';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/myprofile', $data);
        $this->load->view('template/footer');
    }

    public function editprofile()
    {
        $data['user'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('tbl_role', ['id' => $data['user']['role_id']])->row_array();
        $data['title'] = 'Edit Profile';

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('user/editprofile', $data);
            $this->load->view('template/footer');
        } else {
            $id = $this->input->post('id', true);
            $email = htmlspecialchars($this->input->post('email', true));
            $name = htmlspecialchars($this->input->post('name', true));

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|png|jpg|jpeg';
                $config['max_sizes'] = '2048';
                $config['upload_path'] = './assets/app/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];

                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/app/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->set('email', $email);
            $this->db->where('id', $id);
            $this->db->update('tbl_admin');

            $data = [
                'email' => $email
            ];

            $this->session->set_userdata($data);

            $this->session->set_flashdata('message', '
            <div class="alert alert-success" role"alert">Your Profile Has Been Succesfully Update!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('user');
        }
    }

    public function changepassword()
    {
        $data['user'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('tbl_role', ['id' => $data['user']['role_id']])->row_array();
        $data['title'] = 'Account Setting';

        $this->form_validation->set_rules('currentpassword', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('newPassword1', 'Password', 'required|trim|min_length[8]|matches[newPassword2]', [
            'matches' => "Password dont match!",
            'min_length' => "Password too short"
        ]);
        $this->form_validation->set_rules('newPassword2', 'Password', 'required|trim|matches[newPassword1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('user/accountsetting', $data);
            $this->load->view('template/footer');
        } else {
            $current_password = $this->input->post('currentpassword', true);
            $new_password = $this->input->post('newPassword1', true);
            if ($current_password != $data['user']['password']) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger" role"alert">Wrong Current Password!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', ' 
                    <div class="alert alert-danger" role"alert">New password cannot be the same as current password!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('user/changepassword');
                } else {
                    $this->db->set('password', $new_password);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('tbl_admin');
                    $this->session->set_flashdata('message', '
                    <div class="alert alert-success" role"alert">Password Changed!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('user/changepassword');
                }
            }
        }
    }
}
