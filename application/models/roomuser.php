<?php

/**
 * 
 */
class roomuser extends CI_Model
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
    function habiswaktu()
    {
        $update = $this->db->query('UPDATE user_booking SET m_booking_start = NULL, m_booking_end = NULL, m_booking_agenda = NULL, m_booking_PIC = NULL where m_booking_end < now()');
    }
    function cari($yangdicari)
    {
        // Lainkali kwnama kelas di model huruf depan harus huruf kapital
        // mau tanya gan.. untuk lantai yg lain caranya sama dgn ini?
        // klw pencarian semuanya samakan aja.
        // oh iya2 okok mas ini sudah bisa berati ya?
        // uda.
        // ok mas kalo gitu, terima ksih bnyak atas solusinya.. 
        // sama2, gantikan aja nama classnya di model semuanya huruf besar, takutnya  kedepn nnti sudh banyak baris program nnti ketauan error
        // nama classnya itu yg lantai 1 s/d 4 huruf depannya dibuat kapital?
        // maksud saya di model aja
        // yg ini bukam?


        $this->db->from('user_booking');
        $this->db->like('m_booking_start', $yangdicari);
        $this->db->or_like('m_booking_end', $yangdicari);
        $this->db->or_like('m_booking_agenda', $yangdicari);
        $this->db->or_like('m_booking_PIC', $yangdicari);
        $this->db->or_like('m_booking_room_name', $yangdicari);
        $this->db->or_like('lantai', $yangdicari);
        return $this->db->get()->result();
    }
}
