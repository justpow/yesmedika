<?php
class Variants extends MY_Model {
   
    public function get_variants($filters=[])
    {

        if (count($filters) != 0) {
            foreach ($filters as $key => $value) {
               $this->db->where($key, $value);
            }
        }

        $this->db->where('status', VARIANT['ACTIVE']);
        $result = $this->db->get('ym_variant');
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

        $result = $this->db->update('ym_variant', $data);
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }
}