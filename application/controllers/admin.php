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
        //$this->room->habiswaktu();

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
        //$this->room->habiswaktu();

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
        //$this->room->habiswaktu();

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
        //$this->room->habiswaktu();

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


    function tambahruangan($lantai = 1)
    {
        /**
         * Karena lantai masih static, pastikan lantai yang valid hanya nilai di bawah ini.
         */
        $valid_lantai = [1, 2, 3, 4];

        /**
         * Parameter lantai harus integer dan positif number
         */
        $lantai = abs(intval(strval($lantai)));

        /**
         * Pastikan nilai parameter lantai berada dalam list lantai yang valid, kalau tidak kembalikan ke lantai default (1).
         */
        if (!in_array($lantai, $valid_lantai)) {
            $lantai = 1;
        }

        if ($lantai == 1) {
            $datadropdown['lantai1'] = array(
                'Ruang Dosen', 'Ruang Dekan', 'Ruang Sidang'
            );
        } elseif ($lantai == 2) {
            $datadropdown['lantai1'] = array(
                'FT TI1', 'FT TI2', 'FT TI3'
            );
        } elseif ($lantai == 3) {
            $datadropdown['lantai1'] = array(
                '301', '302', '303', '304', '305'
            );
        } else {
            $datadropdown['lantai1'] = array(
                '401', '402', '403', '404', '405', '406'
            );
        }

        $data['title'] = 'Tambah Booking';
        $data['lantai'] = $lantai;
        //$data['dd'] = $this->room->dropdown($lantai);
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/tambahruangan', $datadropdown);
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

    public function check_avaiable_daterange()
    {
        $postData = $this->input->post(null, true);
        $start_date_raw = $postData['m_booking_start'];
        $end_date_raw = $postData['m_booking_end'];

        $room_name = $postData['m_booking_room_name'];
        $lantai = $postData['lantai'];

        //Convert raw to DateTime object
        $start_date = date_create($start_date_raw);
        $end_date = date_create($end_date_raw);

        //Convert date to str for sql format
        $start_date_str = date_format($start_date, "Y:m:d H:i:s");
        $end_date_str = date_format($end_date, "Y:m:d H:i:s");

        $db = $this->db;

        $db->group_start();
        $db->where('m_booking_start <=', $end_date_str);
        $db->where('m_booking_end >=', $start_date_str);
        $db->group_end();

        $db->group_start();
        $db->where('m_booking_room_name', $room_name);
        $db->where('lantai', $lantai);
        $db->group_end();

        // $sql = $db->get_compiled_select('user_booking');
        // var_dump($sql);
        // die;

        $recordCount = $db->count_all_results('user_booking');

        if ($recordCount == 0) {
            return true;
        }
        $this->form_validation->set_message('check_avaiable_daterange', 'Jadwal bentrok, silahkan mencari kelas yang lain', 'The %s ');
        return false;
    }

    function prosesruang()
    {
        $this->load->helper(['form']);
        $this->load->library(['form_validation']);

        /**
         * Gunakan start time sebagai acuan validasi, terkait range jadwal (callback_check_avaiable_daterange).
         * callback_check_avaiable_daterange adalah custom validation, silahkan baca user_guide terkait Form_Vaidation
         * http://localhost/wpulogin/user_guide/libraries/form_validation.html#callbacks-your-own-validation-methods
         * 
         */

        $this->form_validation->set_rules('m_booking_start', 'Jam Mulai', 'required|callback_check_avaiable_daterange');
        $this->form_validation->set_rules('m_booking_end', 'Jam Selesai', 'required');


        if ($this->input->post(null, true)) {
            /**
             * Un-Comment 2 baris di bawah untuk uji date tanpa input, invoke ke variable global $_POST
             */
            //$_POST['m_booking_start'] = "2020-05-03T12:21";
            //$_POST['m_booking_end'] = "2020-05-03T12:25";
        }

        /**
         * Jalankan validasi, form validatin ci3 otomatis mengecek berdasarkan data dari $_POST
         */
        if ($this->form_validation->run()) {

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
            redirect(site_url('admin/lantai' . $m_lantai));
        } else {

            // Jika error, redirect ke form tambah ruangan kembali dengan melakukan set flash data key error_message
            $this->session->set_flashdata('error_message', validation_errors());
            redirect(site_url('admin/tambahruangan'));
            redirect(site_url('admin/editruang'));
        }
    }

    /*function habiswaktu()
    {
        $data['title'] = 'Delete Otomatis';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/lantai');
        $this->load->view('templates/footer');
    }*/

    function sortirhari($a)
    {
        $data['title'] = 'Lantai 1 FT Uhamka';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->room->habiswaktu();

        $data1['room'] = $this->room->sortirhari($a)->result();
        $data['role'] = $this->db->get('user_booking')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/hari', $data1);
        $this->load->view('templates/footer');
    }

    function deleteruang($m_booking_id)
    {
        $m_lantai    = $this->input->post('lantai');
        $where = array('m_booking_id' => $m_booking_id);
        $this->room->deleteruang($where, 'user_booking');
        redirect(base_url('admin/lantai' . $m_lantai));
    }

    function editruang($m_booking_id)
    {

        $data['title'] = 'Edit Ruangan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('m_booking_id' => $m_booking_id);
        $data['data5'] = $this->room->editruang($where, 'user_booking')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/editruang', $data);
        $this->load->view('templates/footer');
    }

    function editruangproses()
    {
        //ini tinggal lu lanjut aja.. samain.. 
        // ntar kalo ada eror bilang
        $m_booking_id = $this->input->post('m_booking_id');
        $m_booking_room_name = $this->input->post('m_booking_name');
        $m_booking_start = $this->input->post('m_booking_start');
        $m_booking_end = $this->input->post('m_booking_end');
        $m_booking_agenda = $this->input->post('m_booking_agenda');
        $m_booking_PIC = $this->input->post('m_booking_PIC');
        $lantai = $this->input->post('lantai');

        $data = array(
            'm_booking_id' => $m_booking_id,
            'm_booking_start' => $m_booking_start,
            'm_booking_end' => $m_booking_end,
            'm_booking_agenda' => $m_booking_agenda,
            'm_booking_PIC' => $m_booking_PIC,
            'm_booking_room_name' => $m_booking_room_name,
            'lantai' => $lantai,

            //biar gampang biasanya orang variablenya disamain
            //lanjutkan gan, ntar klo ada salah gw koreksi lagi
        );

        $where = array(
            'm_booking_id' => $m_booking_id
        );

        $this->room->editruangproses($where, $data, 'user_booking');
        redirect(base_url('admin/lantai' . $lantai));
    }
}
