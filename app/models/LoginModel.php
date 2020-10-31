<?php
/**
 * LoginModel
 */
class LoginModel extends dsModel
{
    public function __construct()
    {
    }

    // Demo function
    public function auth($table, $data)
    {
        return $this->select($table)->where($data)->get_row(PDO::FETCH_ASSOC);
    }
}