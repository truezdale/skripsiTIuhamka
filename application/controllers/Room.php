<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Room extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_room');
    }

    function room()
    {
        $data['room'] = $this->M_room->tampil_room()->result();
        $this->load->view('v_room', $data);
    }

    function booking_room($m_booking_id)
    {
        $where = array('m_booking_id' => $m_booking_id);
        $data['data'] = $this->M_room->booking_room($where, 'm_booking_room')->result();

        $this->load->view('v_room_edit', $data);
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

        $this->M_room->booking_room_proses($where, $data, 'm_booking_room');
        redirect(base_url('Room/Room/room'));
    }
}


/* End of file menu.php */
/* Location: ./application/controllers/menu.php */
