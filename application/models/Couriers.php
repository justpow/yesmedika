<?php
class Couriers extends MY_Model {

    public function insert($data)
    {
        $result = $this->db->insert('ym_payment_doc', $data);
        $error = $this->db->error();
        return $this->db_response($result, $error);
    }

    public function get_cost($origin, $destination, $weight, $courier)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, COURIER['RAJAONGKIR_COST_URL']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'key: '.COURIER['KEY']
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $post = [
            'origin' => $origin,
            'destination' => $destination,
            'weight'   => $weight,
            'courier'   => $courier
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
       
        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);

        $response = json_decode($response);
     
        return $response;
    }
}