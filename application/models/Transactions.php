<?php
class Transactions extends MY_Model {

    public function insert_transaction_product($data)
    {
        $result = $this->db->insert('ym_transaction_product', $data);
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }
    
    public function insert_transaction($data)
    {
        $this->db->insert('ym_transaction', $data);
        $error = $this->db->error();
        return $this->db_response($this->db->insert_id(), $error);
    }

    public function get_transaction($page=1, $per_page=10, $filters=[])
    {
        $start_from = $page - 1;
        if (count($filters) != 0) {
            foreach ($filters as $key => $value) {
               $this->db->where($key, $value);
            }
        }

        $this->db->order_by('id', 'desc');
        $result = $this->db->get('ym_transaction', $per_page, $start_from * $per_page);  
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }
    
    public function get_transaction_product($filters=[])
    {
        if (count($filters) != 0) {
            foreach ($filters as $key => $value) {
               $this->db->where($key, $value);
            }
        }

        $result = $this->db->get('ym_transaction_product');
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }

   
}