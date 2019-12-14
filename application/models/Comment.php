<?php

class Comment extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function tComm()
    {
        $data = [
            'id_comm' => '',
            'timestamp' => date('d m Y |H:i:s'),
            'nama' => $this->input->post('nama'),
            'isi_comm' => $this->input->post('comment'),
            'aspek' => $this->input->post('aspek'),
            'lampiran' => "gggg"
        ];
        $this->db->insert('komentar', $data);
        redirect('home');
    }

    public function  sComm()
    {
        $data = $this->db->query("SELECT * FROM komentar")->result_array();
        return $data;
    }
    public function sComm2($id)
    {
        $data = $this->db->query("SELECT * FROM komentar WHERE id_comm=" . $id)->row_array();
        return $data;
    }

    public function detComm($id)
    { 
         $data = $this->db->query("DELETE FROM komentar WHERE id_comm=" . $id);
         return $data;
    }

    public function uploadfile()
    {
        $file = [
            'fileup' => '',
            'typefile' => "jpg|png|doc|gif|jpeg|pdf",
            'overwrite' => TRUE,
            'size' => "2048000",
            'height' => "768",
            'width' => "1024",
            'file_name' => $this->input->post('lampiran')
        ];

        var_dump($file);
        // die;

        $this->load->library('upload', $file);
        $this->upload->do_upload('lampiran');
        print_r($this->upload->display_errors());
        return $this->upload->data('file_name');
    }
}
