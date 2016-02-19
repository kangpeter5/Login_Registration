<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    function get_all_users()
    {
        return $this->db->query("SELECT * FROM users")->result_array();
    }

	function get_user_by_email($post)
    {
        // var_dump($post); die("in the model");
        $query = "SELECT * FROM users WHERE email = ?";
        $value = array($post);
        return $this->db->query($query, $value)->row_array();
    }

    function register_user($post)
    {
        $query = "INSERT INTO users (first_name, last_name, email, password, created_at) VALUES (?,?,?,?,?)";
        $values = array($post['first_name'], $post['last_name'], $post['email'], $post['password'], date("Y-m-d, H:i:s"));
        return $this->db->query($query, $values);
    }

}

