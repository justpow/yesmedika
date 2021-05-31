<?php
class Cart extends MY_Model {

    public function insert($data)
    {
        $result = $this->db->insert('ym_cart', $data);
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }

    public function get_carts($filters=[])
    {

        if (count($filters) != 0) {
            foreach ($filters as $key => $value) {
               $this->db->where($key, $value);
            }
        }

        $result = $this->db->get('ym_cart');
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }
}