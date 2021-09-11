<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function role()
    {
        $data['user'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('tbl_role', ['id' => $data['user']['role_id']])->row_array();
        $data['title'] = 'Role Access';
        $data['user_role'] = $this->db->get('tbl_role')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('app/role', $data);
        $this->load->view('template/footer');
    }

    public function roleaccess($role_id){
        $data['user'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('tbl_role', ['id' => $data['user']['role_id']])->row_array();
        $data['title'] = 'Role Access';
        $data['role'] = $this->db->get_where('tbl_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('tbl_menu')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('app/roleaccess', $data);
        $this->load->view('template/footer');
    }

    public function addrole()
    {
        $this->db->insert('tbl_role', ['role' => strtolower($this->input->post('role'))]);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success" role"alert">New role has been added
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('settings/role');
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('tbl_access', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('tbl_access', $data);
        } else {
            $this->db->delete('tbl_access', $data);
        }

        $this->session->set_flashdata('message', '
            <div class="alert alert-success" role"alert">Access changed!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
    }


}
