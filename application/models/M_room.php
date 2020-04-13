<?php

/**
 * 
 */
class M_room extends CI_Model
{
	
    function tampil_room(){
        return $this->db->query('SELECT * FROM m_booking_room');
    }

    function booking_room($where,$table){
        return $this->db->get_where($table,$where);
    }

    function booking_room_proses($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

}
