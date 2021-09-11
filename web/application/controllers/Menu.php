<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
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
        $data['menu'] = $this->db->get('tbl_menu')->result_array();
        $data['title'] = 'Menu Management';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('menu/menumanagement', $data);
        $this->load->view('template/footer');
    }

    public function addmenu()
    {
        $this->db->insert('tbl_menu', ['menu' => $this->input->post('title')]);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success" role"alert">New menu has been added
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('menu');
    }

    public function updatemenu()
    {
        $id = $this->input->post('id', true);
        $data = [
            'id' => $id,
            'menu' => htmlspecialchars($this->input->post('title', true))
        ];

        $where = ['id' => $id];

        $this->menu->updateMenu($where, $data, 'tbl_menu');

        $this->session->set_flashdata('message', '
        <div class="alert alert-success" role"alert">Menu has been edited
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('menu');
    }

    public function deletemenu()
    {
        $id = $this->input->post('id', true);
        $where = ['id' => $id];
        $this->menu->deleteMenu($where, 'tbl_menu');
        $this->session->set_flashdata('message', '
            <div class="alert alert-danger" role"alert">Menu has been deleted
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('menu');
    }

    // Sub Menu
    public function submenu()
    {
        $data['user'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('tbl_role', ['id' => $data['user']['role_id']])->row_array();
        $data['title'] = "Sub Menu Management";
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('tbl_menu')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('menu/submenumanagement', $data);
        $this->load->view('template/footer');
    }

    public function addSubMenu()
    {
        $status = $this->input->post('is_active', true);
        if ($status == NULL) {
            $status = 0;
        }
        $data = [
            'title' => htmlspecialchars($this->input->post('title', true)),
            'menu_id' => $this->input->post('menu_id', true),
            'url' => htmlspecialchars($this->input->post('url', true)),
            'icon' => htmlspecialchars($this->input->post('icon', true)),
            'is_active' => $status
        ];

        $this->db->insert('tbl_sub_menu', $data);
        $this->session->set_flashdata('message', '
        <div class="alert alert-success" role"alert">New sub menu has been added
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('menu/submenu');
    }

    public function updatesubmenu()
    {
        $status = $this->input->post('is_active', true);
        if ($status == NULL) {
            $status = 0;
        }
        $id = $this->input->post('id', true);
        $data = [
            'title' => htmlspecialchars($this->input->post('title', true)),
            'menu_id' => $this->input->post('menu_id', true),
            'url' => htmlspecialchars($this->input->post('url', true)),
            'icon' => htmlspecialchars($this->input->post('icon', true)),
            'is_active' => $status
        ];

        $where = ['id' => $id];

        $this->menu->updateMenu($where, $data, 'tbl_sub_menu');

        $this->session->set_flashdata('message', '
        <div class="alert alert-success" role"alert">SubMenu has been edited
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('menu/submenu');
    }

    public function deletesubmenu()
    {
        $id = $this->input->post('id', true);
        $where = ['id' => $id];
        $this->menu->deleteMenu($where, 'tbl_sub_menu');
        $this->session->set_flashdata('message', '
            <div class="alert alert-danger" role"alert">SubMenu has been deleted
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('menu/submenu');
    }
}
