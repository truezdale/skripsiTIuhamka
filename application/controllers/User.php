<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('roomuser');
    }
    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }


    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Profil kamu sudah berubah! </div>');
            redirect('user');
        }
    }
    public function changePassword()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Salah mengubah password! </div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password tidak boleh sama dengan yang sebelumnya! </div>');
                    redirect('user/changepassword');
                } else {
                    // password benar
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password sudah berubah! </div>');
                    redirect('user/changepassword');
                }
            }
        }
    }
    public function lantai1()
    {
        $data['title'] = 'Lantai 1 FT Uhamka';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->roomuser->habiswaktu();
        $data['role'] = $this->db->get('user_booking')->result_array();

        $data['roomuser'] = $this->roomuser->tampil_room_lantai1()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/lantai1', $data);
        $this->load->view('templates/footer');
    }
    public function cariLantai()
    {
        $data['title'] = 'Lantai 1 FT Uhamka';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->roomuser->habiswaktu();
        $data['role'] = $this->db->get('user_booking')->result_array();

        $keyname = $this->input->post('keyword_a');
        // $keytgl = $this->input->post('keyword_b');
        $keytgl = date('Y-m-d H:i:s', strtotime($this->input->post('keyword_b')));
        // $keytgl = str_replace([$tgl], "T", " ");

        if ($keyname) {
            $data['roomuser'] = $this->roomuser->carilantai1($keyname);
        } else {
            $data['roomuser'] = $this->db->get('view_lantai1')->result();
            // $data['roomuser'] = $this->roomuser->tampil_room_lantai1()->result();
        }


        // var_dump($data['roomuser']);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/lantai1', $data);
        $this->load->view('templates/footer');
    }
    public function cariTanggal()
    {
        $data['title'] = 'Lantai 1 FT Uhamka';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->roomuser->habiswaktu();
        $data['role'] = $this->db->get('user_booking')->result_array();

        $keyname = $this->input->post('keyword_a');
        // $keytgl = $this->input->post('keyword_b');
        $keytgl = date('Y-m-d H:i:s', strtotime($this->input->post('keyword_b')));
        // $keytgl = str_replace([$tgl], "T", " ");

        if ($keytgl) {
            $data['roomuser'] = $this->roomuser->keywordtanggal($keytgl);;
        } else {
            $data['roomuser'] = $this->roomuser->tampil_room_lantai1()->result();
        }


        // var_dump($data['roomuser']);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/lantai1', $data);
        $this->load->view('templates/footer');
    }
    public function lantai2()
    {
        $data['title'] = 'Lantai 2 FT Uhamka';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->roomuser->habiswaktu();
        $data['role'] = $this->db->get('user_booking')->result_array();

        $yangdicari = $this->input->post('yangdicari');
        $data['roomuser'] = $this->roomuser->tampil_room_lantai2()->result();
        if ($yangdicari != null) {
            $data['roomuser'] = $this->roomuser->cari($yangdicari);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/lantai2', $data);
        $this->load->view('templates/footer');
    }

    public function cariLantai2()
    { {
            $data['title'] = 'Lantai 2 FT Uhamka';
            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
            $this->roomuser->habiswaktu();
            $data['role'] = $this->db->get('user_booking')->result_array();

            $keyname = $this->input->post('keyword_a');
            // $keytgl = $this->input->post('keyword_b');
            $keytgl = date('Y-m-d H:i:s', strtotime($this->input->post('keyword_b')));
            // $keytgl = str_replace([$tgl], "T", " ");

            if ($keyname) {
                $data['roomuser'] = $this->roomuser->carilantai2($keyname);
            } else {
                $data['roomuser'] = $this->db->get('view_lantai2')->result();
            }


            // var_dump($data['roomuser']);


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/lantai2', $data);
            $this->load->view('templates/footer');
        }
    }

    public function cariTanggal2()
    {
        $data['title'] = 'Lantai 2 FT Uhamka';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->roomuser->habiswaktu();
        $data['role'] = $this->db->get('user_booking')->result_array();

        $keyname = $this->input->post('keyword_a');
        // $keytgl = $this->input->post('keyword_b');
        $keytgl = date('Y-m-d H:i:s', strtotime($this->input->post('keyword_b')));
        // $keytgl = str_replace([$tgl], "T", " ");

        if ($keytgl) {
            $data['roomuser'] = $this->roomuser->keywordtanggal($keytgl);;
        } else {
            $data['roomuser'] = $this->roomuser->tampil_room_lantai2()->result();
        }


        // var_dump($data['roomuser']);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/lantai2', $data);
        $this->load->view('templates/footer');
    }

    public function lantai3()
    {
        $data['title'] = 'Lantai 3 FT Uhamka';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->roomuser->habiswaktu();
        $data['role'] = $this->db->get('user_booking')->result_array();

        $yangdicari = $this->input->post('yangdicari');
        $data['roomuser'] = $this->roomuser->tampil_room_lantai3()->result();
        if ($yangdicari != null) {
            $data['roomuser'] = $this->roomuser->cari($yangdicari);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/lantai3', $data);
        $this->load->view('templates/footer');
    }

    public function cariLantai3()
    { {
            $data['title'] = 'Lantai 3 FT Uhamka';
            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
            $this->roomuser->habiswaktu();
            $data['role'] = $this->db->get('user_booking')->result_array();

            $keyname = $this->input->post('keyword_a');
            // $keytgl = $this->input->post('keyword_b');
            $keytgl = date('Y-m-d H:i:s', strtotime($this->input->post('keyword_b')));
            // $keytgl = str_replace([$tgl], "T", " ");

            if ($keyname) {
                $data['roomuser'] = $this->roomuser->carilantai3($keyname);
            } else {
                $data['roomuser'] = $this->db->get('view_lantai3')->result();
            }


            // var_dump($data['roomuser']);


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/lantai3', $data);
            $this->load->view('templates/footer');
        }
    }

    public function cariTanggal3()
    {
        $data['title'] = 'Lantai 3 FT Uhamka';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->roomuser->habiswaktu();
        $data['role'] = $this->db->get('user_booking')->result_array();

        $keyname = $this->input->post('keyword_a');
        // $keytgl = $this->input->post('keyword_b');
        $keytgl = date('Y-m-d H:i:s', strtotime($this->input->post('keyword_b')));
        // $keytgl = str_replace([$tgl], "T", " ");

        if ($keytgl) {
            $data['roomuser'] = $this->roomuser->keywordtanggal($keytgl);;
        } else {
            $data['roomuser'] = $this->roomuser->tampil_room_lantai3()->result();
        }


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/lantai3', $data);
        $this->load->view('templates/footer');
    }

    public function lantai4()
    {
        $data['title'] = 'Lantai 4 FT Uhamka';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->roomuser->habiswaktu();
        $data['role'] = $this->db->get('user_booking')->result_array();

        $yangdicari = $this->input->post('yangdicari');
        $data['roomuser'] = $this->roomuser->tampil_room_lantai4()->result();
        if ($yangdicari != null) {
            $data['roomuser'] = $this->roomuser->cari($yangdicari);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/lantai4', $data);
        $this->load->view('templates/footer');
    }
    public function cariLantai4()
    { {
            $data['title'] = 'Lantai 4 FT Uhamka';
            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
            $this->roomuser->habiswaktu();
            $data['role'] = $this->db->get('user_booking')->result_array();

            $keyname = $this->input->post('keyword_a');
            // $keytgl = $this->input->post('keyword_b');
            $keytgl = date('Y-m-d H:i:s', strtotime($this->input->post('keyword_b')));
            // $keytgl = str_replace([$tgl], "T", " ");

            if ($keyname) {
                $data['roomuser'] = $this->roomuser->carilantai4($keyname);
            } else {
                $data['roomuser'] = $this->db->get('view_lantai4')->result();
            }


            // var_dump($data['roomuser']);


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/lantai4', $data);
            $this->load->view('templates/footer');
        }
    }

    public function cariTanggal4()
    {
        $data['title'] = 'Lantai 4 FT Uhamka';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->roomuser->habiswaktu();
        $data['role'] = $this->db->get('user_booking')->result_array();

        $keyname = $this->input->post('keyword_a');
        // $keytgl = $this->input->post('keyword_b');
        $keytgl = date('Y-m-d H:i:s', strtotime($this->input->post('keyword_b')));
        // $keytgl = str_replace([$tgl], "T", " ");

        if ($keytgl) {
            $data['roomuser'] = $this->roomuser->keywordtanggal($keytgl);;
        } else {
            $data['roomuser'] = $this->roomuser->tampil_room_lantai4()->result();
        }


        // var_dump($data['roomuser']);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/lantai4', $data);
        $this->load->view('templates/footer');
    }

    public function request()
    {

        $data['title'] = 'Request Peminjaman';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/request');
        $this->load->view('templates/footer');
    }
    public function do_upload()
    {
        $config['upload_path']   = './uploaded_file/';
        $config['allowed_types'] = 'doc|docx|xls|xlsx|pdf|zip|rar';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_nya')) {
            $error =  $this->upload->display_errors();
            $this->session->set_flashdata(
                'warning',
                '<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' .
                    $error . '</div>'
            );
            redirect(base_url('user/request'));
        } else {
            $this->session->set_flashdata(
                'warning',
                '<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>File Berhasil diupload</div>'
            );
            redirect(base_url('user/request'));
        }
    }
}
