<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('room');
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {

        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Akses sudah berubah! </div>');
    }

    public function lantai1()
    {
        $data['title'] = 'Lantai 1 FT Uhamka';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->room->habiswaktu();

        $data1['room'] = $this->room->tampil_room_lantai1()->result();
        $data['role'] = $this->db->get('user_booking')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/lantai1', $data1);
        $this->load->view('templates/footer');
    }

    public function lantai2()
    {
        $data['title'] = 'Lantai 2 FT Uhamka';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->room->habiswaktu();

        $data2['room'] = $this->room->tampil_room_lantai2()->result();
        $data['role'] = $this->db->get('user_booking')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/lantai2', $data2);
        $this->load->view('templates/footer');
    }
    public function lantai3()
    {
        $data['title'] = 'Lantai 3 FT Uhamka';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->room->habiswaktu();

        $data3['room'] = $this->room->tampil_room_lantai3()->result();
        $data['role'] = $this->db->get('user_booking')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/lantai3', $data3);
        $this->load->view('templates/footer');
    }

    public function lantai4()
    {
        $data['title'] = 'Lantai 4 FT Uhamka';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->room->habiswaktu();

        $data4['room'] = $this->room->tampil_room_lantai4()->result();
        $data['role'] = $this->db->get('user_booking')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/lantai4', $data4);
        $this->load->view('templates/footer');
    }

    function addbooking($m_booking_id)
    {
        $data['title'] = 'Tambah Booking';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('m_booking_id' => $m_booking_id);
        $data5['data'] = $this->room->addbooking($where, 'user_booking')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/add-booking', $data5);
        $this->load->view('templates/footer');
    }
    function tambahruangan()
    {
        $data['title'] = 'Tambah Booking';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/tambahruangan');
        $this->load->view('templates/footer');
    }

    function booking_room_proses($m_booking_id)
    {
        $m_booking_start  = $this->input->post('m_booking_start');
        $m_booking_end    = $this->input->post('m_booking_end');
        $m_booking_agenda = $this->input->post('m_booking_agenda');
        $m_booking_PIC    = $this->input->post('m_booking_PIC');

        $data = array(
            'm_booking_id'      => $m_booking_id,
            'm_booking_start'   => $m_booking_start,
            'm_booking_end'     => $m_booking_end,
            'm_booking_agenda'  => $m_booking_agenda,
            'm_booking_PIC'     => $m_booking_PIC
        );
        $where = array(
            'm_booking_id' => $m_booking_id
        );

        $this->room->booking_room_proses($where, $data, 'user_booking');
        redirect(base_url('admin/lantai1'));
    }
    function prosesruang()
    {
        $m_booking_start  = $this->input->post('m_booking_start');
        $m_booking_end    = $this->input->post('m_booking_end');
        $m_booking_agenda = $this->input->post('m_booking_agenda');
        $m_booking_PIC    = $this->input->post('m_booking_PIC');
        $m_booking_room_name    = $this->input->post('m_booking_room_name');
        $m_lantai    = $this->input->post('lantai');

        $data = array(
            'm_booking_start'   => $m_booking_start,
            'm_booking_end'     => $m_booking_end,
            'm_booking_agenda'  => $m_booking_agenda,
            'm_booking_PIC'     => $m_booking_PIC,
            'm_booking_room_name'     => $m_booking_room_name,
            'lantai'     => $m_lantai
        );
        $this->room->prosesruang($data, 'user_booking');
        redirect(base_url('admin/lantai' . $m_lantai));
    }
    function habiswaktu()
    {
        $data['title'] = 'Delete Otomatis';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/lantai');
        $this->load->view('templates/footer');
    }
}
