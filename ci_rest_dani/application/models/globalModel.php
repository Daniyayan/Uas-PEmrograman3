<?php
defined('BASEPATH') or exit('No direct script access allowed');

class globalModel extends CI_Model 
{
    public function getData($column, $values, $table)
    {
        $result = '';
        if($values) {
            $this->db->from($table);
            $this->db->where($column, $values);
            $result = $this->db->get()->row_array();
        } else {
            $this->db->from($table);
            $result = $this->db->get()->result_array();
        }
        return $result;
    }

    public function insert($data, $table)
    {
        $result = false;
        if($data){
            $this->db->insert($table, $data);
            $result = $this->db->affected_rows();
        }
        return $result;
    }

    public function update($values, $column, $table, $data)
    {       
        $result = false;
        if ($data) {
            $this->db->where($column, $values);
            $this->db->update($table, $data);
            $result = $this->db->affected_rows();
        }
        return $result;
    }
    
    public function delete($values, $column, $table)
    {
        $result = false;
        if ($values) {
            $this->db->where($column, $values);
            $this->db->delete($table);
            $result = $this->db->affected_rows();
        }
        return $result;
    }
}

?>