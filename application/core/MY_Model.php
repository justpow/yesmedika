<?php
class MY_Model extends CI_Model {
    public function db_response($data, $error)
    {
        return (object)[
            'data'  => $data,
            'error' => $error
        ];
    }
}