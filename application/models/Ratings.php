<?php
class Ratings extends MY_Model {
   
    public function get_reviews($page=1, $per_page=10, $filters=[])
    {
        $start_from = $page - 1;
        if (count($filters) != 0) {
            foreach ($filters as $key => $value) {
               $this->db->where($key, $value);
            }
        }

        $result = $this->db->get('ym_rating', $per_page, $start_from * $per_page);
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }

    public function update($data, $filters=[])
    {
        if (count($filters) != 0) {
            foreach ($filters as $key => $value) {
               $this->db->where($key, $value);
            }
        }

        $result = $this->db->update('ym_rating', $data);
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }

    public function insert($data)
    {
        $result = $this->db->insert('ym_rating', $data);
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }
}