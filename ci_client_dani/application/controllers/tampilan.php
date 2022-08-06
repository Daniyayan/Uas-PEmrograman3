<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa_model'); //load model mahasiswa
        $this->load->library('Form_validation'); //load form validation
    }

    public function index()
    {
        $data['title'] = "List Data Mahasiswa";

        $data['data_mahasiswa'] = $this->Mahasiswa_model->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('mahasiswa/index', $data);
        $this->load->view('templates/footer');
    }
    public function detail($npm)
    {
        $data['title'] = "Detail Data Mahasiswa";

        $data['data_mahasiswa'] = $this->Mahasiswa_model->getById($npm);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('mahasiswa/detail', $data);
        $this->load->view('templates/footer');
    }
    public function add()
    {

        $data['title'] = "Tambah Data Mahasiswa";

        $this->form_validation->set_rules('npm', 'NPM', 'trim|required|numeric');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('agama', 'Agama', 'trim|required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'trim|required|numeric|min_length[9]|max_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('mahasiswa/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                "npm"           => $this->input->post('npm'),
                "nama"          => $this->input->post('nama'),
                "jenis_kelamin" => $this->input->post('jenis_kelamin'),
                "alamat"        => $this->input->post('alamat'),
                "agama"         => $this->input->post('agama'),
                "no_hp"         => $this->input->post('no_hp'),
                "email"         => $this->input->post('email'),
                "KEY"           => "ulbi123"
            ];

            $insert = $this->Mahasiswa_model->save($data);
            if ($insert['response_code'] === 201) {
                $this->session->set_flashdata('flash', 'Data Ditambahkan Kelas');
                redirect('Mahasiswa');
            } elseif ($insert['response_code'] === 400) {
                $this->session->set_flashdata('message', 'Data Duplikat !');
                redirect('Mahasiswa');
            } else {
                $this->session->set_flashdata('message', 'Data gagal Ditambahkan Bestie!');
                redirect('Mahasiswa');
            }
        }
    }
    public function edit($npm)
    {
        $data['title'] = "Ubah Data Mahasiswa";
        $data['data_mahasiswa'] = $this->Mahasiswa_model->getById($npm);

        $this->form_validation->set_rules('npm', 'NPM', 'trim|required|numeric');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis_Kelamin', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('agama', 'Agama', 'trim|required');
        $this->form_validation->set_rules('no_hp', 'No_Hp', 'trim|required|min_length[9]|max_length[13]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('mahasiswa/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                "npm" => $this->input->post('npm'),
                "nama" => $this->input->post('nama'),
                "jenis_kelamin" => $this->input->post('jenis_kelamin'),
                "alamat" => $this->input->post('alamat'),
                "agama" => $this->input->post('agama'),
                "no_hp" => $this->input->post('no_hp'),
                "email" => $this->input->post('email'),
                "KEY" => "ulbi123"
            ];

            $update = $this->Mahasiswa_model->update($data);
            if ($update['response_code'] === 201) {
                $this->session->set_flashdata('flash', 'Data dapat diubah');
                redirect('Mahasiswa');
            } elseif ($update['response_code'] === 400) {
                $this->session->set_flashdata('message', 'Data gagal diubah');
                redirect('Mahasiswa');
            } else {
                $this->session->set_flashdata('message', 'Data gagal diubah');
                redirect('Mahasiswa');
            }
        }
    }
    public function delete($npm)
    {
        $update = $this->Mahasiswa_model->delete($npm);
        if ($update['response_code'] === 200) {
            $this->session->set_flashdata('flash', 'Data Dihapus Bestie');
            redirect('Mahasiswa');
        } else {
            $this->session->set_flashdata('message', 'Gagal!!');
            redirect('Mahasiswa');
        }
    }
}
