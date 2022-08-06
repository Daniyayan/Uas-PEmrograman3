<?php

defined('BASEPATH') or exit('No direct script access allowed');

//import library dari Format dan REST_Controller
// require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/REST_Controller.php';

// use chriskacerguis\RestServer\REST_Controller;
//extends class dari RestController

class restApiMasterObat extends REST_Controller 
{
    protected $table;
    protected $column;
    protected $msgSuccess;
    protected $msgBadReq; 
    protected $msgCreated;
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('globalModel');
        $this->table      = "tbl_master_obat"; // ganti jika ingin menambahklan controller baru
        $this->column     = "kode_obat"; // ganti jika ingin menambahklan controller baru
        $this->msgSuccess = REST_Controller::HTTP_OK;
        $this->msgBadReq  = REST_Controller::HTTP_BAD_REQUEST;
        $this->msgCreated = REST_Controller::HTTP_CREATED;
    }

    // endpint adalah mrObat 
    // method adalah (get, put, post, delete)
    public function mrObt_get() { 
        $values = $this->get('kode_obat');
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
                ],
                $this->msgBadReq
            );
        }
    }

    public function mrObt_post() {
        $kode_obat          = $this->post('kode_obat');
        $jenis_obat         = $this->post('jenis_obat');
        $kategori_obat      = $this->post('kategori_obat');
        $harga_obat         = $this->post('harga_obat');
        $tgl_kedaluwarsa    = $this->post('tgl_kedaluwarsa');
        $created_at         = $this->post('created_at');

        // Cek jika data yang di input kosong
        if ($kode_obat == null || $jenis_obat == null || $kategori_obat == null || $created_at == null || $harga_obat == null || $tgl_kedaluwarsa == null) {
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
            $cekdata = $this->globalModel->getData($this->column, $kode_obat, $this->table);

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
                    'kode_obat'         => $kode_obat,
                    'jenis_obat'        => $jenis_obat,
                    'kategori_obat'     => $kategori_obat,
                    'harga_obat'        => $harga_obat,
                    'tgl_kedaluwarsa'   => $tgl_kedaluwarsa,
                    'created_at'        => $created_at
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

    public function mrObt_put() {
        $kode_obat          = $this->put('kode_obat');
        $jenis_obat         = $this->put('jenis_obat');
        $kategori_obat      = $this->put('kategori_obat');
        $harga_obat         = $this->put('harga_obat');
        $tgl_kedaluwarsa    = $this->put('tgl_kedaluwarsa');
        $created_at         = $this->put('created_at');

        // Cek jika data yang di input kosong
        if ($kode_obat == null || $jenis_obat == null || $kategori_obat == null || $created_at == null || $harga_obat == null || $tgl_kedaluwarsa == null) {
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
                'kode_obat'         => $kode_obat,
                'jenis_obat'        => $jenis_obat,
                'kategori_obat'     => $kategori_obat,
                'harga_obat'        => $harga_obat,
                'tgl_kedaluwarsa'   => $tgl_kedaluwarsa,
                'created_at'        => $created_at
            ];
            
            $updateData = $this->globalModel->update($kode_obat, $this->column, $this->table, $data); //input data ke tabel
            
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

    public function mrObt_delete()
    {
        $values = $this->delete('kode_obat');

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