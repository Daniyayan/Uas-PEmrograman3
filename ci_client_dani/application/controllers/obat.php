<?php
defined('BASEPATH') or exit('No direct script access allowed');

class obat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('obtMskModel'); //load model obat
        $this->load->library('Form_validation'); //load form validation
    }

    public function index()
    {
        $data['title'] = "List Data obat";

        $data['data_obat'] = $this->obtMskModel->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('obat/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id_obat)
    {
        $data['title'] = "Detail Data obat";

        $data['data_mahasiswa'] = $this->obts_model->getById($id_obat);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('obat/detail', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {

        $data['title'] = "Tambah Data obat";

        $this->form_validation->set_rules('id_obat', 'ID Obat', 'trim|required|numeric');
        $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'trim|required');
        $this->form_validation->set_rules('jenis_obat', 'Jenis Obat', 'trim|required');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal masuk', 'trim|required');
        $this->form_validation->set_rules('bentuk_obat', 'Bentuk Obat', 'trim|required');
        $this->form_validation->set_rules('harga_beli', 'Harga Obat', 'trim|required|numeric|min_length[9]|max_length[12]');
        $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'trim|required|valid_required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('obat/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                "id_obat"           => $this->input->post('id_obat'),
                "nama_obat"          => $this->input->post('nama_obat'),
                "jenis_obat" => $this->input->post('jenis_obat'),
                "bentuk_obat"        => $this->input->post('bentuk_obat'),
                "tanggal_masuk"         => $this->input->post('tanggal_masuk'),
                "harga_beli"         => $this->input->post('harga_beli'),
                "jumlah_masuk"         => $this->input->post('jumlah_masuk'),
                "KEY"           => "ulbi123"
            ];

            $insert = $this->obtMskModel->save($data);
            if ($insert['response_code'] === 201) {
                $this->session->set_flashdata('flash', 'Data Ditambahkan Kelas');
                redirect('obat');
            } elseif ($insert['response_code'] === 400) {
                $this->session->set_flashdata('message', 'Data Duplikat !');
                redirect('obat');
            } else {
                $this->session->set_flashdata('message', 'Data gagal Ditambahkan Bestie!');
                redirect('obat');
            }
        }
    }

    public function edit($id_obat)
    {
        $data['title'] = "Ubah Data Obat";
        $data['data_Obat'] = $this->obtMskModel->getById($id_obat);

        $this->form_validation->set_rules('id_obat', 'ID obat', 'trim|required|numeric');
        $this->form_validation->set_rules('nama_obat', 'Nama_Obat', 'trim|required');
        $this->form_validation->set_rules('jenis_obat', 'Jenis_Obat', 'trim|required');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'trim|required');
        $this->form_validation->set_rules('bentuk_obat', 'Bentuk Obat', 'trim|required');
        $this->form_validation->set_rules('harga_beli', 'Harga Beli', 'trim|required|min_length[9]|max_length[13]');
        $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'trim|required|valid_jumlahmasuk');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('obat/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                "id_obat"           => $this->input->post('id_obat'),
                "nama_obat"          => $this->input->post('nama_obat'),
                "jenis_obat" => $this->input->post('jenis_obat'),
                "bentuk_obat"        => $this->input->post('bentuk_obat'),
                "tanggal_masuk"         => $this->input->post('tanggal_masuk'),
                "harga_beli"         => $this->input->post('harga_beli'),
                "jumlah_masuk"         => $this->input->post('jumlah_masuk'),
                "KEY"           => "ulbi123"
            ];

            $update = $this->obtMskModel->update($data);
            if ($update['response_code'] === 201) {
                $this->session->set_flashdata('flash', 'Data dapat diubah');
                redirect('Mahasiswa');
            } elseif ($update['response_code'] === 400) {
                $this->session->set_flashdata('message', 'Data gagal diubah');
                redirect('obat');
            } else {
                $this->session->set_flashdata('message', 'Data gagal diubah');
                redirect('obat');
            }
        }
    }
    
    public function delete($id_obat)
    {
        $update = $this->obtMskModel->delete($id_obat);
        if ($update['response_code'] === 200) {
            $this->session->set_flashdata('flash', 'Data Dihapus Bestie');
            redirect('obat');
        } else {
            $this->session->set_flashdata('message', 'Gagal!!');
            redirect('obat');
        }
    }
}
