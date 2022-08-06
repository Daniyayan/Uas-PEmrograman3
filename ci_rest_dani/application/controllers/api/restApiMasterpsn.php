<?php

defined('BASEPATH') or exit('No direct script access allowed');

//import library dari Format dan REST_Controller
// require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/REST_Controller.php';

// use chriskacerguis\RestServer\REST_Controller;
//extends class dari RestController

class restApiMasterdiagnos extends REST_Controller 
{
    protected $table;
    protected $column;
    protected $msgSuccess;
    protected $msgBadReq; 
    protected $msgCreated;
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('globalModel');
        $this->table      = "tbl_pasien"; // ganti jika ingin menambahklan controller baru
        $this->column     = "id_pasien"; // ganti jika ingin menambahklan controller baru
        $this->msgSuccess = REST_Controller::HTTP_OK;
        $this->msgBadReq  = REST_Controller::HTTP_BAD_REQUEST;
        $this->msgCreated = REST_Controller::HTTP_CREATED;
    }

    // endpint adalah mrObat 
    // method adalah (get, put, post, delete)
    public function mrpsn_get() { 
        $values = $this->get('id_pasien');
        $data = $this->globalModel->getData($this->column, $values, $this->table);
        if ($data) {
            $this->response(
                [
                    'status'        => true,
                    'response_code' => $this->msgSuccess,
                    'message'       => 'Data Berhasil Ditampilkan',
                    'data'          => $data
                ],
                $this->msgSuccess
            );
        } else {
            $this->response(
                [
                    'status'        => false,
                    'response_code' => $this->msgBadReq,
                    'message'       => 'Data Gagal Ditampilkan',
                    'data'          => $data
                ],
                $this->msgBadReq
            );
        }
    }

    public function mrpsn_post() {
        $id_pasien       = $this->post('id_pasien');
        $tempat_lahir    = $this->post('tempat_lahir');
        $nama_pasien     = $this->post('nama_pasien');
        $tanggal_lahir   = $this->post('tanggal_lahir');
        $jk_pasien       = $this->post('jk_pasien');
        $umur_pasien     = $this->post('umur_pasien');
        $alamat_pasien    = $this->post('alamat_pasien');
        $agama           = $this->post('agama');
        $tlp_pasien    = $this->post('tlp_pasien');
        // Cek jika data yang di input kosong
        if ($id_pasien == null || $tempat_lahir == null || $nama_pasien == null 
        || $umur_pasien == null || $tanggal_lahir == null || $jk_pasien == null 
        || $alamat_pasien ==null || $agama == null || $tlp_pasien == null) {
            $this->response(
                [
                    'response_code' => $this->msgBadReq,
                    'status'        => false,
                    'message'       => 'Data Yang Dikirim Tidak Boleh Ada Yang Kosong',
                ],
                $this->msgBadReq
            );
        } else { // data dati input terisi

            // pengecekan jika id barang sudah ada di tabel
            $cekdata = $this->globalModel->getData($this->column, $id_pasien, $this->table);

            if ($cekdata) { // jika id barang ada
                $this->response(
                    [
                        'status'        => false,
                        'response_code' => $this->msgBadReq,
                        'message'       => 'Data Sudah Ada',
                    ],
                    $this->msgBadReq
                );
            } else { // jika id barang tidak tersedia

                // kumpul data input kedalam array
                $data = [
                    'id_pasien'             => $id_pasien,
                    'tempat_lahir'          => $tempat_lahir,
                    'nama_pasien'           => $nama_pasien,
                    'tanggal_lahir'         => $tanggal_lahir,
                    'jk_pasien'             => $jk_pasien,
                    'umur_pasien'           => $umur_pasien,
                    'alamat_pasien'         => $alamat_pasien,
                    'agama'                 => $agama,
                    'tpl_pasien'            => $tlp_pasien
                ];
                
                $inputData = $this->globalModel->insert($data, $this->table); // input data ke tabel

                if ($inputData) { // cek jika data berhasil
                    $this->response(
                        [
                            'status'        => true,
                            'response_code' => $this->msgCreated,
                            'message'       => 'Data Berhasil Ditambahkan',
                        ],
                        $this->msgCreated
                    );
                } else { // hasil jika data gagal di insert
                    $this->response(
                        [
                            'status'        => false,
                            'response_code' => $this->msgBadReq,
                            'message'       => 'Gagal Menambahkan Data',
                        ],
                        $this->msgBadReq
                    );
                }
            }
        }
    }

    public function mrpsn_put() {
        $id_pasien       = $this->put('id_pasien');
        $tempat_lahir    = $this->put('tempat_lahir');
        $nama_pasien     = $this->put('nama_pasien');
        $tanggal_lahir   = $this->put('tanggal_lahir');
        $jk_pasien       = $this->put('jk_pasien');
        $umur_pasien     = $this->put('umur_pasien');
        $alamat_pasien    = $this->put('alamat_pasien');
        $agama           = $this->put('agama');
        $tlp_pasien    = $this->put('tlp_pasien');
        // Cek jika data yang di input kosong
        if ($id_pasien == null || $tempat_lahir == null || $nama_pasien == null 
        || $umur_pasien == null || $tanggal_lahir == null || $jk_pasien == null 
        || $alamat_pasien ==null || $agama == null || $tlp_pasien == null) {
            $this->response(
                [
                    'satus'         => false,
                    'response_code' => $this->msgBadReq,
                    'message'       => 'Data yang di kirim tidak boleh kosong',
                ],
                $this->msgBadReq
            );
        } else{ //juka id barang tidak tersedia

            //kumpulan data input dalam array
            $data = [
                'id_pasien'            => $id_pasien,
                'tempat_lahir'         => $tempat_lahir,
                'nama_pasien'          => $nama_pasien,
                'tanggal_lahir'        => $tanggal_lahir,
                'jk_pasien'            => $jk_pasien,
                'umur_pasien'          => $umur_pasien,
                'alamat_pasien'        => $alamat_pasien,
                'agama'                 => $agama,
                'tlp_pasien'            => $tlp_pasien
            ];
            
            $updateData = $this->globalModel->update($id_pasien, $this->column, $this->table, $data); //input data ke tabel
            
            if ($updateData) { //input data berhasil
                $this->response(
                    [
                        'satus'         => true,
                        'response_code' => $this->msgCreated,
                        'message'       => 'Data Bserhasil Di Ubah',
                    ],
                    $this->msgCreated
                );
            } else {
                $this->response(
                    [
                        'status'        => false,
                        'response_code' => $this->msgBadReq,
                        'message'       => 'Gagal Mengubah Data',
                    ],
                    $this->msgBadReq
                );
            }
        }
    }

    public function mrpsn_delete()
    {
        $values = $this->delete('id_pasien');

        if ($values == null) {
            $this->response(
                [
                    'status'        => false,
                    'response_code' => $this->msgBadReq,
                    'message'       => 'Id barang  Tidak Boleh Kosong',
                ],
                $this->msgBadReq
            );
        } else {
            $deletedata = $this->globalModel->delete($values, $this->column, $this->table);

            if ($deletedata) {
                $this->response(
                    [
                        'status'        => true,
                        'response_code' => $this->msgSuccess,
                        'message'       => 'Data barang d engan id barang ' . $values . ' berhasil dihapus',
                    ],
                    $this->msgSuccess
                );
            } else {
                $this->response(
                    [
                        'status'        => false,
                        'response_code' => $this->msgBadReq,
                        'message'       => 'Gagal Menghapus Data',
                    ],
                    $this->msgBadReq
                );
            }
        }
    }
}