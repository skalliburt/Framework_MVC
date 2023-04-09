<?php

class Article{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function obtenerArticulos(){
        $this->db->query("SELECT * FROM `Articulo`");
        return $this->db->records();
    }
}