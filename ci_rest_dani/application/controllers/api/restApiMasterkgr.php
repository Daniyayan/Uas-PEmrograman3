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
        $this->table      = "tbl_kategori"; // ganti jika ingin menambahklan controller baru
        $this->column     = "id_kgr"; // ganti jika ingin menambahklan controller baru
        $this->msgSuccess = REST_Controller::HTTP_OK;
        $this->msgBadReq  = REST_Controller::HTTP_BAD_REQUEST;
        $this->msgCreated = REST_Controller::HTTP_CREATED;
    }

    // endpint adalah mrObat 
    // method adalah (get, put, post, delete)
    public function mrkgr_get() { 
        $values = $this->get('id_kgr');
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

    public function mrkgr_post() {
        $id_kgr          = $this->post('id_kgr');
        $kd_kgr         = $this->post('kd_kgr');
        $nm_kgr      = $this->post('nm_kgr');
        $created_at         = $this->post('created_at');
       
      

        // Cek jika data yang di input kosong
        if ($id_kgr == null || $kd_kgr == null || $nm_kgr == null ||  $created_at == null ) {
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
            $cekdata = $this->globalModel->getData($this->column, $id_kgr, $this->table);

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
                    'id_kgr'         => $id_kgr,
                    'kd_kgr'        => $kd_kgr,
                    'nm_kgr'     => $nm_kgr,
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

    public function mrkgr_put() {
        $id_kgr          = $this->put('id_kgr');
        $kd_kgr         = $this->put('kd_kgr');
        $nm_kgr      = $this->put('nm_kgr');
        $created_at         = $this->put('created_at');
   

        // Cek jika data yang di input kosong
        if ($id_kgr == null || $kd_kgr == null || $nm_kgr == null ||  $created_at == null ) {
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
                'id_kgr'         => $id_kgr,
                'kd_kgr'        => $kd_kgr,
                'nm_kgr'     => $nm_kgr,
                'created_at'        => $created_at
            ];
            
            $updateData = $this->globalModel->update($id_kgr, $this->column, $this->table, $data); //input data ke tabel
            
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

    public function mrkgr_delete()
    {
        $values = $this->delete('id_kgr');

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