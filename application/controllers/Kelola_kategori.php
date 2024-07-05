<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_kategori extends CI_Controller
{
    var $module_js = ['kelola-kategori'];
    var $app_data = [];

    public function __construct()
    {
        parent::__construct();
        $this->_init();
    }


    private function _init()
    {
        $this->app_data['module_js'] = $this->module_js;
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('view_kategori');
        $this->load->view('footer');
        $this->load->view('js-custom', $this->app_data);
    }

    public function get_data()
    {
        $result = $this->data->get_all('kategori')->result();
        echo json_encode($result);
    }

    public function get_data_id()
    {
        $id = $this->input->post('id');
        $where = array('id' => $id);
        $result = $this->data->find('kategori', $where)->result();
        echo json_encode($result);
    }

    public function insert_data()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|is_unique[kategori.nama]');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $nama = $this->input->post('nama');
            $keterangan = $this->input->post('keterangan');
            $data = array(
                'nama' => $nama,
                'keterangan' => $keterangan,
            );
            $this->data->insert('kategori', $data);

            $response['success'] = "Data berhasil ditambahkan";
        }
        echo json_encode($response);
    }

    public function edit_data()
    {     
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $keterangan = $this->input->post('keterangan');
            $timestamp = $this->db->query("SELECT NOW() as timestamp")->row()->timestamp;

            $data = array(
                'nama' => $nama,
                'keterangan' => $keterangan,
                'updated_at' => $timestamp,
            );

            $where = array('id' => $id);
            $this->data->update('kategori', $where, $data);

            $response['success'] = "Data berhasil diupdate";
        }
        echo json_encode($response);
    }

    public function delete_data()
    {
        $id = $this->input->post('id');
        $where = array('id' => $id);

        $count_letter = $this->data->count_where('surat', 'id_kategori', $id);

        if ($count_letter > 0) {
            $response['error'] = "GAGAL, Data kategori terdapat pada surat";
        } else {
            $deleted = $this->data->delete('kategori', $where);
            if ($deleted) {
                $response['success'] = "Data berhasil dihapus";
            } else {
                $response['error'] = "Gagal menghapus data";
            }
        }


        echo json_encode($response);
    }
}