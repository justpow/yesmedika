<?php
class UserAddress extends MY_Model {
   
    public function insert($data="")
    {
        $check = $this->get(array('id_user' => $this->session->userdata('user')['id']));
        if ($check->data->num_rows() > 0) {
            if ( $data['is_utama'] == '1' )
            {
                $this->db->set('is_utama', '0');
                $this->db->update('ym_address');

                $result = $this->db->insert('ym_address', $data);
                $error = $this->db->error();
                return $this->db_response($result, $error);
            }
            else 
            {
                $result = $this->db->insert('ym_address', $data);
                $error = $this->db->error();
                return $this->db_response($result, $error);
            }
        } 
        else
        {
            $data['is_utama'] = '1';
            $result = $this->db->insert('ym_address', $data);
            $error = $this->db->error();
            return $this->db_response($result, $error);
        }

        
    }
    
    public function update($data="", $param="")
    {
        $this->db->set($data);
        ($param == "") ? '' : $this->db->where($param) ;
        $result = $this->db->update('ym_address');
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }

    public function get($data="")
    {
        $this->db->select('*'); 
        $this->db->from('ym_address');
        $this->db->where($data);
        $result = $this->db->get();
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }

    public function get_address_wilayah($data="")
    {
        $this->db->select('address.*, a.nama as nama_kelurahan, b.nama as nama_kecamatan, c.nama as nama_kota, d.nama as nama_provinsi'); 
        $this->db->from('ym_address as address');
        $this->db->join('wilayah_2020 as a', 'address.kelurahan = a.kode', 'left');
        $this->db->join('wilayah_2020 as b', 'address.kecamatan = b.kode', 'left');
        $this->db->join('wilayah_2020 as c', 'address.city = c.kode', 'left');
        $this->db->join('wilayah_2020 as d', 'address.province = d.kode', 'left');
        $this->db->where($data);
        $this->db->order_by('address.id', 'DESC');
        $result = $this->db->get();
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }

    public function get_wilayah($param="")
    {

        $this->db->select('*');
        $this->db->from('wilayah_2020');
        $this->db->where($param);
        $this->db->order_by('nama', 'ASC');
        $result = $this->db->get();
        $error = $this->db->error();
        return $this->db_response($result, $error);

    }

    public function delete($data="")
    {

        $check = $this->get(array('id' => $data['id']));
        $check = $check->data->result_array();

        $this->db->where($data);
        $result = $this->db->delete('ym_address');
        $error = $this->db->error();

        if ($check[0]['is_utama'] == 1) 
        {
            $this->db->select('id');
            $this->db->from('ym_address');
            $this->db->order_by('id', 'desc');
            $result = $this->db->get()->result_array();

            $this->db->set('is_utama', '1');
            $this->db->where('id', $result[0]['id']) ;
            $result = $this->db->update('ym_address');

        }
        
        return $this->db_response($result, $error);

    }

}