<?php
class Products extends MY_Model {
   
    public function get_products($page=1, $per_page=10, $query='', $sort_by='id', $order_by='desc', $brand='', $minPrice='', $maxPrice='', $filters=[])
    {
        $start_from = $page - 1;
        if (isset($query)) {
            $this->db->like('name', $query);
        }

        if (isset($order_by)) {
            $this->db->order_by($sort_by, $order_by);
        }
        
        if ($brand != '') {
            $this->db->where_in('category_id', $brand);
        }
        
        if ($minPrice != '') {
            $this->db->where('price >=', $minPrice);
        }
        
        if ($maxPrice != '') {
            $this->db->where('price <=', $maxPrice);
        }

        if (count($filters) != 0) {
            foreach ($filters as $key => $value) {
               $this->db->where($key, $value);
            }
        }

        $this->db->where('status', PRODUCT['ACTIVE']);
        $result = $this->db->get('ym_product', $per_page, $start_from * $per_page);
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

        $result = $this->db->update('ym_product', $data);
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }
}