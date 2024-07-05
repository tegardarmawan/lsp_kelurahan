<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	
	# Catatan: 
	# 	1. Penulisan Controller nama file harus sama dengan nama controller dan di nama file huruf pertama kapital
	# 	2. Penulisan Model harus sama dengan nama model, terdapat suffix _model dan huruf pertama kapital 
	# 	3. Gaya penulisan menggunakan snake_case jadi penulisan function maupun class menggunakan pemisah underscore jika terdiir dari 2 kata
	# 	4. Kata kata yg digunakan menuggnakan bahasa inggris 
	# 	5. Jika helper dan library sudah di inputkan di autoload tidak perlu dipanggil ulang didalam controller tinggal panggilnya methodnya saja

	public function index()
	{
		// Contoh Penggunaan 
		$id = 17; // Contoh id
		$query = [
            'select' => 'a.nama mahasiswa, b.nama_prodi',
            'from' => 'mahasiswa a',
            'join' => [
                'prodi b, b.id_prodi = a.id_prodi, left'
            ],
            // 'where' => [
            //     'a.id' => $id
            // ]
        ];
		// contoh query find
		$data['find'] = $this->data->find('mahasiswa', [
			'id' => $id,
			'is_deleted' => '0',
		])->row();
		// Tambah data
		$data['insert'] = $this->data->insert('mahasiswa', ['nama' => random_string(), 'id_prodi' => 1]);
		// Query get
		$data['get'] = $this->data->get($query)->result(); 
		$this->load->view('test', $data);
	}
}
