<?php

/**
 * 
 */
class room extends CI_Model
{

    function tampil_room_lantai1()
    {
        return $this->db->query('SELECT * FROM user_booking where lantai=1');
    }

    function tampil_room_lantai2()
    {
        return $this->db->query('SELECT * FROM user_booking where lantai=2');
    }

    function tampil_room_lantai3()
    {
        return $this->db->query('SELECT * FROM user_booking where lantai=3');
    }

    function tampil_room_lantai4()
    {
        return $this->db->query('SELECT * FROM user_booking where lantai=4');
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

    function prosesruang($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function habiswaktu()
    {
        $delete = $this->db->query('DELETE from user_booking where m_booking_end < now()');
    }
}
