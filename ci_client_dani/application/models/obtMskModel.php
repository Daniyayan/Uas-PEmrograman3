<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class obtMskModel extends CI_Model
{
    private $_guzzle;

    public function __construct()
    {
        parent::__construct();
        $this->_guzzle = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://localhost/AppRestFullApi/ci_client_dani/api/restApiObtMasuk/obtMsk',
            // You can set any number of default request options.
            'auth'  => ['dani', 'd4n1'],
        ]);
    }

    public function getAll()
    {
        $response = $this->_guzzle->request('GET', '', [
            'query' => [
                'KEY' => 'd4n1'
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), TRUE);

        return $result['data'];
    }
    public function getById($kode_obt_msk)
    {
        $response = $this->_guzzle->request('GET', '', [
            'query' => [
                'KEY' => 'd4n1',
                'kode_obt_msk' => $kode_obt_msk
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), TRUE);

        return $result['data'];
    }
    public function save($data)
    {
        $response = $this->_guzzle->request('POST', '', [
            'http_errors' => false,
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), TRUE);

        return $result;
    }

    public function update($data)
    {
        $response = $this->_guzzle->request('PUT', '', [
            'http_errors' => false,
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), TRUE);

        return $result;
    }

    public function delete($kode_obt_msk)
    {
        $response = $this->_guzzle->request('DELETE', '', [
            'form_params' => [
                'http_errors' => false,
                'KEY' => 'd4n1',
                'kode_obt_msk' => $kode_obt_msk
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), TRUE);

        return $result;
    }
}
