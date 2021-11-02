
<?php
class Payment extends MY_Model {

    public function insert($data)
    {
        $result = $this->db->insert('ym_payment_doc', $data);
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }

    public function get($filters=[], $sort_by='create_time', $order_by='desc')
    {
        if (count($filters) != 0) {
            foreach ($filters as $key => $value) {
               $this->db->where($key, $value);
            }
        }

        if (isset($order_by)) {
            $this->db->order_by($sort_by, $order_by);
        }

        $result = $this->db->get('ym_payment_doc');
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

        $result = $this->db->update('ym_payment_doc', $data);
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }
}