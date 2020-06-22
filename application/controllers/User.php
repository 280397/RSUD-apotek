<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_admin_1();
        check_not_login();
        $this->load->model('User_model');
        $this->load->model('Ruang_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data = array(
            'title' => "User Page"
        );
        $this->load->view('user/user_data', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->User_model->json();
    }

    public function read($id)
    {
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'username' => $row->username,
                'password' => $row->password,
                'name' => $row->name,
                'address' => $row->address,
                'level' => $row->level,
            );
            $this->load->view('user/user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('User'));
        }
    }

    public function create()
    {
        $data = array(
            'title' => 'User Page',
            'page' => 'Create User',
            'button' => 'Create',
            'action' => site_url('User/create_action'),
            'id' => set_value('id'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            'name' => set_value('name'),
            'address' => set_value('address'),
            'level' => set_value('level'),
            'id_ruang' => $this->Ruang_model->get_all(),
        );
        $this->load->view('user/user_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
            // redirect(site_url('User'));
        } else {
            $data = array(
                'username' => htmlspecialchars($this->input->post('username', TRUE)),
                'password' => sha1($this->input->post('password', TRUE)),
                'name' => $this->input->post('name', TRUE),
                'address' => $this->input->post('address', TRUE),
                'level' => $this->input->post('level', TRUE),
                'id_ruang' => $this->input->post('id_ruang', TRUE),
            );

            $this->User_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Berhasil menambah data!
            </div>
          </div>');
            redirect(site_url('User'));
        }
    }

    public function update($id)
    {
        $row = $this->User_model->get_by_id($id);
        // var_dump($row);
        // die;
        if ($row) {
            $data = array(
                'title' => 'User Page',
                'page' => 'Update User',
                'button' => 'Update',
                'action' => site_url('User/update_action'),
                'id' => set_value('id', $row->id),
                'username' => set_value('username', $row->username),
                'password' => set_value('password', $row->password),
                'name' => set_value('name', $row->name),
                'address' => set_value('address', $row->address),
                'level' => set_value('level', $row->level),
                'id_ruang' => set_value('id_ruang', $row->id_ruang),
                'ruang' => $this->Ruang_model->get_all(),
            );
            $this->load->view('user/user_edit', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Data tidak ditemukan!
            </div>
          </div>');
            redirect(site_url('User'));
        }
    }

    public function update_action()
    {
        // $this->_rules();
        $this->form_validation->set_rules('username', 'Username', 'trim|min_length[5]|callback_username_check', [
            'min_length' => 'Username too short!'
        ]);
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|matches[passwordconf]', [
                'matches' => 'Password dont match!',
                'min_length' => 'Password too short!'
            ]);
            $this->form_validation->set_rules('passwordconf', 'Confirm Password', 'trim|matches[password]');
        }
        if ($this->input->post('passwordconf')) {
            $this->form_validation->set_rules('passwordconf', 'Confirm Password', 'trim|matches[password]', ['matches' => 'Password dont match!']);
        }

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'username' => htmlspecialchars($this->input->post('username', TRUE)),
                'password' => sha1($this->input->post('password', TRUE)),
                'name' => $this->input->post('name', TRUE),
                'address' => $this->input->post('address', TRUE),
                'level' => $this->input->post('level', TRUE),
                'id_ruang' => $this->input->post('id_ruang', TRUE),
            );

            $this->User_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Berhasil memperbarui data!
            </div>
          </div>');
            redirect(site_url('User'));
        }
    }

    public function delete($id)
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Berhasil menghapus data!
            </div>
          </div>');
            redirect(site_url('User'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Data tidak ditemukan!
            </div>
          </div>');
            redirect(site_url('User'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|min_length[5]|is_unique[user.username]', [
            'min_length' => 'Username too short!',
            'is_unique' => 'Username already taken!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|matches[passwordconf]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('passwordconf', 'Password', 'trim|matches[password]');
    }
    function username_check()
    {
        $post = $this->input->post(null, true);
        $query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND id != '$post[id]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('username_check', 'Username already used, please use another one!');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-08 03:47:37 */
/* http://harviacode.com */
