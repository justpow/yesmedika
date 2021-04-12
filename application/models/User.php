<?php
class User extends MY_Model {
   
    public function insert_user($data)
    {
        $result = $this->db->insert('ym_user', $data);
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }
}