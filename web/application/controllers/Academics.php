<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Academics extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db_api = $this->load->database('db_api', TRUE);
    }

    public function classtimetable()
    {
        $data['user'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('tbl_role', ['id' => $data['user']['role_id']])->row_array();
        $data['title'] = 'Class Timetable';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('academic/class-timetable', $data);
        $this->load->view('template/footer');
    }

    public function teachertimetable()
    {
        $data['user'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('tbl_role', ['id' => $data['user']['role_id']])->row_array();
        $data['title'] = 'Teacher Timetable';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('academic/teacher-timetable', $data);
        $this->load->view('template/footer');
    }

    public function assignclassteacher()
    {
        $data['user'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('tbl_role', ['id' => $data['user']['role_id']])->row_array();
        $data['title'] = 'Assign Class Teacher';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('academic/assign-class-teacher', $data);
        $this->load->view('template/footer');
    }

    public function subjectgroub()
    {
        $data['user'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('tbl_role', ['id' => $data['user']['role_id']])->row_array();
        $data['title'] = 'Subject Groub';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('academic/subject-groub', $data);
        $this->load->view('template/footer');
    }

    public function subject()
    {
        $data['user'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('tbl_role', ['id' => $data['user']['role_id']])->row_array();
        $data['subject'] = $this->db_api->get('api_mapel')->result_array();
        $data['title'] = 'Subject';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('academic/subject', $data);
        $this->load->view('template/footer');
    }

    public function addsubject()
    {
        $this->db_api->insert(
            'api_mapel',
            [
                'nama_mapel' => htmlspecialchars($this->input->post('subject', true)),
                'kode_mapel' => htmlspecialchars($this->input->post('code', true))
            ]
        );

        $this->session->set_flashdata('message', '
            <div class="alert alert-success" role"alert">Subject has been added
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('academics/subject');
    }

    public function class()
    {
        $data['user'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('tbl_role', ['id' => $data['user']['role_id']])->row_array();
        $data['section'] = $this->db_api->get('api_bagian')->result_array();
        $query_class = "SELECT `api_kelas`.* , `api_bagian`.*
                FROM `api_kelas` JOIN `api_bagian`
                ON `api_kelas`.`id_bagian` = `api_bagian`.`id`
                ";
        $data['section_class'] = $this->db_api->query($query_class)->result_array();
        $query = $this->db_api->query("SELECT id, nama_kelas, id_bagian FROM api_kelas GROUP BY nama_kelas ORDER BY nama_kelas DESC");
        $data['class'] = $query->result_array();

        $data['title'] = 'Class';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('academic/class', $data);
        $this->load->view('template/footer');
    }

    public function addclass()
    {
        $name_class = $this->input->post('class');
        $section_arr = $this->input->post('checked');
        for ($i = 0; $i < count($section_arr); $i++) {
            $section_id = $section_arr[$i];
            $this->db_api->insert(
                'api_kelas',
                [
                    'nama_kelas' => $name_class,
                    'id_bagian' => $section_id
                ]
            );
        }

        $this->session->set_flashdata('message', '
            <div class="alert alert-success" role"alert">Class has been added
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('academics/class');
    }

    public function updateclass()
    {
        $class_id = $this->input->post('id_class');
        $name_class = htmlspecialchars($this->input->post('class', true));
        $class = $this->db_api->get_where('api_kelas', ['nama_kelas' => $class_id])->result_array();

        foreach ($class as $_class) :
            $this->db_api->set('nama_kelas', $name_class);
            $this->db_api->where('id', $_class['id']);
            $this->db_api->update('api_kelas');
        endforeach;

        $this->session->set_flashdata('message', '
        <div class="alert alert-success" role"alert">Class has been edited
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('academics/class');
    }

    public function sections()
    {
        $data['user'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('tbl_role', ['id' => $data['user']['role_id']])->row_array();
        $data['section'] = $this->db_api->get('api_bagian')->result_array();
        $data['title'] = 'Sections';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('academic/section', $data);
        $this->load->view('template/footer');
    }
}
