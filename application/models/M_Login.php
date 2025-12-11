<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Login extends CI_Model{ 

  var $TABLE = "users";
    var $COLUMN = array(
        "id",
        // "id_opd",
        "username",
        "password",
        "level",
    );

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function read(): mixed{
       
            $this->db->select("*");
            $this->db->from($this->TABLE);
            $query = $this->db->get();
            return $query->result();

    }

  public function readBy($username){
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('username', $username);
            $query = $this->db->get();
            return $query->row();

    }
}