<?php

defined('BASEPATH') or exit('No direct script access allowed');

//import library dari Format dan REST_Controller
// require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/REST_Controller.php';

// use chriskacerguis\RestServer\REST_Controller;
//extends class dari RestController

class restApiMasterpby extends REST_Controller 
{
    protected $table;
    protected $column;
    protected $msgSuccess;
    protected $msgBadReq; 
    protected $msgCreated;
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('globalModel');
        $this->table      = "tbl_pembayaran"; // ganti jika ingin menambahklan controller baru
        $this->column     = "id"; // ganti jika ingin menambahklan controller baru
        $this->msgSuccess = REST_Controller::HTTP_OK;
        $this->msgBadReq  = REST_Controller::HTTP_BAD_REQUEST;
        $this->msgCreated = REST_Controller::HTTP_CREATED;
    }

    // endpint adalah mrObat 
    // method adalah (get, put, post, delete)
    public function mrpby_get() { 
        $values = $this->get('id');
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

    public function mrpby_post() {
        $id          = $this->post('id');
        $id_pembayaran         = $this->post('id_pembayaran');
        $id_transaksi      = $this->post('id_transaksi');
        $tanggal_bayar         = $this->post('tanggal_bayar');
        $total_bayar    = $this->post('total_bayar');
        $pasien_bayar         = $this->post('pasien_bayar');
        $kembalian         = $this->post('kembalian');
        // Cek jika data yang di input kosong
        if ($id == null || $id_pembayaran == null || $id_transaksi == null || $pasien_bayar == null || $tanggal_bayar == null || $total_bayar == null|| $kembalian == null) {
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
            $cekdata = $this->globalModel->getData($this->column, $id, $this->table);

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
                    'id'         => $id,
                    'id_pembayaran'        => $id_pembayaran,
                    'id_transaksi'     => $id_transaksi,
                    'tanggal_bayar'        => $tanggal_bayar,
                    'total_bayar'   => $total_bayar,
                    'pasien_bayar'        => $pasien_bayar,
                    'kembalian'           => $kembalian
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

    public function mrpby_put() {
        $id          = $this->put('id');
        $id_pembayaran         = $this->put('id_pembayaran');
        $id_transaksi      = $this->put('id_transaksi');
        $tanggal_bayar         = $this->put('tanggal_bayar');
        $total_bayar    = $this->put('total_bayar');
        $pasien_bayar         = $this->put('pasien_bayar');
        $kembalian         = $this->put('kembalian');
        // Cek jika data yang di input kosong
        if ($id == null || $id_pembayaran == null || $id_transaksi == null || $pasien_bayar == null || $tanggal_bayar == null || $total_bayar == null|| $kembalian == null)  {
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
                'id'         => $id,
                'id_pembayaran'        => $id_pembayaran,
                'id_transaksi'     => $id_transaksi,
                'tanggal_bayar'        => $tanggal_bayar,
                'total_bayar'   => $total_bayar,
                'pasien_bayar'        => $pasien_bayar
            ];
            
            $updateData = $this->globalModel->update($id, $this->column, $this->table, $data); //input data ke tabel
            
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

    public function mrpby_delete()
    {
        $values = $this->delete('id');

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