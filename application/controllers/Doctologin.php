<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctologin extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Docto_Model");
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index(){
        $this->load->view("doctonew/layout");
        $this->load->view("doctonew/login");
    }

    public function login_form(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user_data = $this->Docto_Model->login_user($username, $password);
        if ($user_data) {
            $this->session->set_userdata($user_data);
            redirect('Doctologin/main');
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password.');
            redirect('Doctologin');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('Doctologin');
    }

    public function main(){
        if ($this->session->userdata('logged_in')) {
            $this->load->view("doctonew/layout");
            $this->load->view('doctonew/homepage');
        } else {
            redirect('Doctologin');
        }
    }

    public function saveform(){
        if ($this->input->is_ajax_request()){
            $this->form_validation->set_rules('username', 'User Name', 'required');
            $this->form_validation->set_rules('clinicid', 'Clinic Id', 'required');
            $this->form_validation->set_rules('server', 'Server', 'required');

            if ($this->form_validation->run() == FALSE){
                $data = array('responce' => 'error', 'message' => validation_errors());
            } else {
                $ajax_data = $this->input->post();

                if (!$this->Docto_Model->checkDuplicateEntry($ajax_data['username'], $ajax_data['clinicid'], $ajax_data['server'])) {
                    if ($this->Docto_Model->insert_entry($ajax_data)){
                        $data = array('responce' => 'success', 'message' => 'Data added successfully');
                    } else {
                        $data = array('responce' => 'error', 'message' => 'Failed to insert data');
                    }
                } else {
                    $data = array('responce' => 'error', 'message' => 'Duplicate entry found');
                }
            }
        } else {
            $data = array('responce' => 'error', 'message' => 'No AJAX request');
        }

        echo json_encode($data);
    }
    public function fetch() {
        if ($this->input->is_ajax_request()) {
            $limit = 50;
            $offset = 0;
            $allFilter = $this->input->post('filter_category') == '4' ? $this->input->post('filter_value') : '';
            $usernameFilter = $this->input->post('filter_category') == '1' ? $this->input->post('filter_value') : '';
            $serverFilter = $this->input->post('filter_category') == '3' ? $this->input->post('filter_value') : '';
            $clinicFilter = $this->input->post('filter_category') == '2' ? $this->input->post('filter_value') : '';

            $posts = $this->Docto_Model->get_entries($limit, $offset,$allFilter, $usernameFilter, $serverFilter, $clinicFilter);
            echo json_encode($posts);
        }
    }


    public function delete(){
        if ($this->input->is_ajax_request()){
            $del_id = $this->input->post('del_id');
            if ($this->Docto_Model->delete_entry($del_id)) {
                $data = array('responce'=> "success");
            } else {
                $data = array('responce' => "error");
            }
        }
        echo json_encode($data);
    }
}
