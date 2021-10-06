<?php
class User extends MY_Model {
   
    public function insert($data)
    {
        $result = $this->db->insert('ym_user', $data);
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }
    
    public function update($param, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $param['id']);
        $result = $this->db->update('ym_user');
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }

    public function get($data)
    {
        $this->db->select('user.*, role.title'); 
        $this->db->from('ym_user user');
        $this->db->join('ym_role role', 'user.role_id = role.id', 'left');
        $this->db->where($data);
        $result = $this->db->get();
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }

    public function get_role_permission($data)
    {
        $this->db->select('permission_id');
        $this->db->from('ym_role_permission');
        $this->db->where($data);
        $result = $this->db->get();
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }
}