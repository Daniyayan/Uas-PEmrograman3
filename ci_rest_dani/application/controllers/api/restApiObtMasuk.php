<?php 
defined('BASEPATH') or exit('No direct script access allowed');

//import library dari Format dan REST_Controller
// require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/REST_Controller.php';

// use chriskacerguis\RestServer\REST_Controller;
//extends class dari RestController

class restApiObtMasuk extends REST_Controller 
{
    protected $table;
    protected $column;
    protected $msgSuccess;
    protected $msgBadReq; 
    protected $msgCreated;

    public function __construct() {
        parent:: __construct();
        $this->load->model('globalModel');
        $this->table      = "tbl_obat_masuk";
        $this->column     = "kode_obt_msk";
        $this->msgSuccess = REST_Controller::HTTP_OK;
        $this->msgBadReq  = REST_Controller::HTTP_BAD_REQUEST;
        $this->msgCreated = REST_Controller::HTTP_CREATED;
    }

    // public function obtMsk_get() {
    //     $values = $this->get('kode_obt_msk');
    //     $data   = $this->globalModel->getData($this->column, $values, $this->table);
    //     if ($data) {
    //         $this->response(
    //             [
    //                 'status'        => true,
    //                 'response_code' => $this->msgSuccess,
    //                 'message'       => 'Data Berhasil Ditampilkan',
    //                 'data'          => $data
    //             ],
    //             $this->msgSuccess
    //         );
    //     } else {
    //         $this->response(
    //             [
    //                 'status'        => false,
    //                 'response_code' => $this->msgBadReq,
    //                 'message'       => 'Data Gagal Ditampilkan',
    //                 'data'          => $data
    //             ],
    //             $this->msgBadReq
    //         );
    //     }
    // }

    public function obtMsk_get() {
        $kode_obt_msk   = $this->get('kode_obt_msk');
        $tanggal_masuk  = $this->get('tanggal_masuk');
        $nama_obat      = $this->get('nama_obat');
        $jenis_obat     = $this->get('jenis_obat');
        $bentuk_obat    = $this->get('bentuk_obat');
        $harga_beli     = $this->get('harga_beli');
        $jumlah_masuk   = $this->get('jumlah_masuk');

        // Cek jika data yang di input kosong
        if ($kode_obt_msk == null) {
            $this->response(
                [
                    'status'        => false,
                    'response_code' => $this->msgBadReq,
                    'message'       => 'Data Tidak Boleh Kosong',
                ],
                $this->msgBadReq
            );
        } else { // data dati input terisi

            // pengecekan jika id barang sudah ada di tabel
            $cekdata = $this->globalModel->getData($this->column, $kode_obt_msk, $this->table);

            if ($cekdata) { // jika id barang ada
                $this->response(
                    [
                        'status'        => false,
                        'response_code' => $this->msgBadReq,
                        'message'       => 'Gagal Menampilkan Data',
                    ],
                    $this->msgBadReq
                );
            } else { // jika id barang tidak tersedia

                // kumpul data input kedalam array
                $data = [
                    'kode_obt_msk'  => $kode_obt_msk,
                    'tanggal_masuk' => $tanggal_masuk,
                    'nama_obat'     => $nama_obat,
                    'jenis_obat'    => $jenis_obat,
                    'bentuk_obat'   => $bentuk_obat,
                    'harga_beli'    => $harga_beli,
                    'jumlah_masuk'  => $jumlah_masuk
                ];
                
                $inputData = $this->globalModel->insert($data, $this->table); // input data ke tabel

                if ($inputData) { // cek jika data berhasil
                    $this->response(
                        [
                            'status'        => true,
                            'response_code' => $this->msgCreated,
                            'message'       => 'Data Berhasil Ditampilkan',
                        ],
                        $this->msgCreated
                    );
                } else { // hasil jika data gagal di insert
                    $this->response(
                        [
                            'status'        => false,
                            'response_code' => $this->msgBadReq,
                            'message'       => 'Gagal Menampilkan Data',
                        ],
                        $this->msgBadReq
                    );
                }
            }
        }
    }


    public function obtMsk_post() {
        $kode_obt_msk   = $this->post('kode_obt_msk');
        $tanggal_masuk  = $this->post('tanggal_masuk');
        $nama_obat      = $this->post('nama_obat');
        $jenis_obat     = $this->post('jenis_obat');
        $bentuk_obat    = $this->post('bentuk_obat');
        $harga_beli     = $this->post('harga_beli');
        $jumlah_masuk   = $this->post('jumlah_masuk');

        // Cek jika data yang di input kosong
        if ($kode_obt_msk == null || $tanggal_masuk == null || $nama_obat == null || $jenis_obat == null || $jumlah_masuk == null || $bentuk_obat == null || $harga_beli == null) {
            $this->response(
                [
                    'status'        => false,
                    'response_code' => $this->msgBadReq,
                    'message'       => 'Data Yang Dikirim Tidak Boleh Ada Yang Kosong',
                ],
                $this->msgBadReq
            );
        } else { // data dati input terisi

            // pengecekan jika id barang sudah ada di tabel
            $cekdata = $this->globalModel->getData($this->column, $kode_obt_msk, $this->table);

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
                    'kode_obt_msk'  => $kode_obt_msk,
                    'tanggal_masuk' => $tanggal_masuk,
                    'nama_obat'     => $nama_obat,
                    'jenis_obat'    => $jenis_obat,
                    'bentuk_obat'   => $bentuk_obat,
                    'harga_beli'    => $harga_beli,
                    'jumlah_masuk'  => $jumlah_masuk
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

    public function obtMsk_put() {
        $kode_obt_msk   = $this->put('kode_obt_msk');
        $tanggal_masuk  = $this->put('tanggal_masuk');
        $nama_obat      = $this->put('nama_obat');
        $jenis_obat     = $this->put('jenis_obat');
        $bentuk_obat    = $this->put('bentuk_obat');
        $harga_beli     = $this->put('harga_beli');
        $jumlah_masuk   = $this->put('jumlah_masuk');

        // Cek jika data yang di input kosong
        if ($kode_obt_msk == null || $tanggal_masuk == null || $nama_obat == null || $jenis_obat == null || $jumlah_masuk == null || $bentuk_obat == null || $harga_beli == null) {
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
            $data = array(
                'kode_obt_msk'  => $kode_obt_msk,
                'tanggal_masuk' => $tanggal_masuk,
                'nama_obat'     => $nama_obat,
                'jenis_obat'    => $jenis_obat,
                'bentuk_obat'   => $bentuk_obat,
                'harga_beli'    => $harga_beli,
                'jumlah_masuk'  => $jumlah_masuk
            );
            
            $updateData = $this->globalModel->update($kode_obt_msk, $this->column, $this->table, $data); //input data ke tabel
            
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

    public function obtMsk_delete()
    {
        $kode_obt_msk = $this->delete('kode_obt_msk');

        if ($kode_obt_msk == null) {
            $this->response(
                [
                    'status' => false,
                    'response_code' => $this->msgBadReq,
                    'message' => 'Id barang  Tidak Boleh Kosong',
                ],
                $this->msgBadReq
            );
        } else {
            $deletedata = $this->globalModel->delete($kode_obt_msk, $this->column, $this->table);

            if ($deletedata) {
                $this->response(
                    [
                        'status' => true,
                        'response_code' => $this->msgSuccess,
                        'message' => 'Data barang dengan id barang ' . $kode_obt_msk . ' berhasil dihapus',
                    ],
                    $this->msgSuccess
                );
            } else {
                $this->response(
                    [
                        'status' => false,
                        'response_code' => $this->msgBadReq,
                        'message' => 'Gagal Menghapus Data',
                    ],
                    $this->msgBadReq
                );
            }
        }
    }
}
?>