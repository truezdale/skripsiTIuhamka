<?php

/**
 * 
 */
class room extends CI_Model
{

    function tampil_room()
    {
        return $this->db->query('SELECT * FROM user_booking');
    }

    function addbooking($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    function booking_room_proses($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
