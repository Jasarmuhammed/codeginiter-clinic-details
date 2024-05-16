<?php
class Docto_Model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function login_user($username, $password){
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('logintable');
        $find_user = $query->num_rows();

        if ($find_user > 0) {
            $user_data = array(
                'username' => $username,
                'logged_in' => TRUE
            );
            return $user_data;
        } else {
            return false;
        }
    }


    public function get_entries($limit, $offset, $allFilter, $usernameFilter, $serverFilter, $clinicFilter) {
      $this->db->select('*');
      $this->db->from('doctosmartnew');



      if (!empty($usernameFilter)) {
          $this->db->like('username', $usernameFilter);
      }
      if (!empty($serverFilter)) {
          $this->db->where('server', $serverFilter);
      }
      if (!empty($clinicFilter)) {
          $this->db->where('clinicid', $clinicFilter);
      }

      $this->db->limit($limit, $offset);
      $query = $this->db->get();

      if ($query->num_rows() > 0) {
          return $query->result_array();
      } else {
          return array(); 
      }
  }


    public function checkDuplicateEntry($username, $clinicid, $server) {
        $this->db->where('username', $username);
        $this->db->where('clinicid', $clinicid);
        $this->db->where('server', $server);
        $query = $this->db->get('doctosmartnew');

        return $query->num_rows() > 0;
    }

    public function insert_entry($data) {
        $username = $data['username'];
        $clinicid = $data['clinicid'];
        $server = $data['server'];

        if ($this->checkDuplicateEntry($username, $clinicid, $server)) {
            return false;
        } else {
            return $this->db->insert('doctosmartnew', $data);
        }
    }

    public function delete_entry($id){
        return $this->db->delete('doctosmartnew', array('id' => $id));
    }
}
