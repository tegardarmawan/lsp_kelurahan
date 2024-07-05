<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_arsip extends CI_Controller
{
    var $module_js = ['kelola-arsip'];
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
        $this->app_data['select'] = $this->data->get_all('kategori')->result();

        $this->load->view('header');
        $this->load->view('view_arsip', $this->app_data);
        $this->load->view('footer');
        $this->load->view('js-custom', $this->app_data);
    }

    public function get_data()
    {
        $query = [
            'select' => 'a.id, a.nomor, a.judul, a.created_at, a.file_name, b.nama',
            'from' => 'surat a',
            'join' => [
                'kategori b, b.id = a.id_kategori'
            ]
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }

    public function get_data_id()
    {
        $id = $this->input->post('id');
        $query = [
            'select' => 'a.id, a.nomor, a.judul, a.created_at, a.file_name, b.nama',
            'from' => 'surat a',
            'join' => [
                'kategori b, b.id = a.id_kategori'
            ],
            'where' => [
                'a.id' => $id
            ]
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }


    public function insert_data()
    {
        $this->form_validation->set_rules('nomor', 'Nomor', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($_FILES['file']['name'])) {
                $response['errors']['file'] = "File harus diupload";
            }
            if (empty($this->input->post('kategori'))) {
                $response['errors']['kategori'] = "Kategori harus dipilih";
            }
        } else {
            $nomor = $this->input->post('nomor');
            $keterangan = $this->input->post('keterangan');
            $kategori = $this->input->post('kategori');

            if (empty($_FILES['file']['name'])) {
                $response['errors']['file'] = "File harus diupload";
            }
            if (empty($kategori)) {
                $response['errors']['kategori'] = "Kategori harus dipilih";
            } else {
                $data = array(
                    'nomor' => $nomor,
                    'id_kategori' => $kategori,
                    'judul' => $keterangan,
                );

                if (!empty($_FILES['file']['name'])) {
                    $currentDateTime = date('Y-m-d_H-i-s');
                    $config['upload_path'] = './assets/file/';
                    $config['allowed_types'] = 'pdf';
                    $config['file_name'] = "Surat-" . $currentDateTime;
                    $config['max_size'] = 5000;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('file')) {
                        $response['errors']['file'] = strip_tags($this->upload->display_errors());
                    } else {
                        $uploaded_data = $this->upload->data();
                        $data['file_name'] = $uploaded_data['file_name'];
                        $this->data->insert('surat', $data);
                    }
                }
                $response['success'] = "Data berhasil ditambahkan";
            }
        }
        echo json_encode($response);
    }

    public function delete_data()
    {
        $id = $this->input->post('id');
        $where = array('id' => $id);

        $file_name = $this->data->get_file_name('surat', $where, 'file_name');

        $deleted = $this->data->delete('surat', $where);
        if ($deleted) {
            $file_path = './assets/file/' . $file_name;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $response['success'] = "Data berhasil dihapus";
        } else {
            $response['error'] = "Gagal menghapus data";
        }
        echo json_encode($response);
    }

    public function download_file($fileName)
    {
        $filePath = FCPATH . 'assets/file/' . $fileName;

        if (file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        } else {
            echo "File not found";
        }
    }

    public function edit_data()
    {
        $id = $this->input->post('id');
        $timestamp = $this->db->query("SELECT NOW() as timestamp")->row()->timestamp;
        $where = array('id' => $id);
        $file_name = $this->data->get_file_name('surat', $where, 'file_name');

        if (!empty($_FILES['file2']['name'])) {
            $currentDateTime = date('Y-m-d_H-i-s');
            $config['upload_path'] = './assets/file/';
            $config['allowed_types'] = 'pdf';
            $config['file_name'] = "Surat-" . $currentDateTime;
            $config['max_size'] = 5000;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file2')) {
                $upload_data = $this->upload->data();
                $data = array(
                    'file_name' => $upload_data['file_name'],
                    'updated_at' => $timestamp,
                );
                $where = array('id' => $id);
                $updated = $this->data->update('surat', $where, $data);
                if ($updated) {
                    $file_path = './assets/file/' . $file_name;
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                    $response['success'] = "Data berhasil diupdate";
                } else {
                    $response['error'] = "Gagal menghapus data";
                }
            } else {
                $response['errors']['file2'] = strip_tags($this->upload->display_errors());
            }
        } else {
            $response['success'] = "Tidak melakukan update data";
        }
        echo json_encode($response);
    }
}
