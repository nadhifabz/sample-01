<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of masterRumah
 *
 * @author ASUS
 */
class Rumah {
    
    private $idrumah, $nama, $no_rumah, $status, $rt, $no_telp;
    
    public function __construct() {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }
    
    public function index() {
        $query = "SELECT * FROM rumah";
        $sql = $this->conn->query($query);
    }
}

$rumah = new Rumah();
$result = $rumah->index();

while ($row = mysql_fetch_array($result)) {
    echo 'idruma = '.$rumah;
}

