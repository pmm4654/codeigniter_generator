<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller {

    public function __construct() 
    {
        parent::__construct();
    }

    function index()
    {
        if ($this->ion_auth->logged_in())
        {
            redirect('users/home');
        }
        else
        {
            $form_location = 'users/login';
        }
        $data['identity'] = array(
            'name'  => 'identity',
            'id'    => 'identity',
            'type'  => 'text',
            'class' => 'form-control'
        );
        $data['password'] = array(
            'name'  => 'password',
            'id'    => 'password',
            'type'  => 'password',
            'class' => 'form-control'
        );
        $data['form_location'] = $form_location;
        $data['view_file'] = 'login';
        echo Modules::run('template/admin', $data);
    }

    function home() {
        if (!$this->ion_auth->logged_in())
        {
            redirect('users');
        }
        $data['user'] = $this->ion_auth->user()->row();
        $data['view_file'] = 'profile';
        echo Modules::run('template/admin', $data);     
    }

    function signup() 
    {
        $data['first_name'] = array(
            'name'  => 'first_name',
            'id'    => 'first_name',
            'type'  => 'text',
            'class' => 'form-control'
        );
        $data['last_name'] = array(
            'name'  => 'last_name',
            'id'    => 'last_name',
            'type'  => 'text',
            'class' => 'form-control'
        );
        $data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'type'  => 'email',
            'class' => 'form-control'
        );
        $data['phone'] = array(
            'name'  => 'phone',
            'id'    => 'phone',
            'type'  => 'phone',
            'class' => 'form-control'
        );
        $data['password'] = array(
            'name'  => 'password',
            'id'    => 'password',
            'type'  => 'password',
            'class' => 'form-control'
        );
        $data['form_location'] = 'users/create_user';
        $data['view_file'] = 'signup';
        echo Modules::run('template/admin', $data);
    }

    function create_user() {
        $data = $this->input->post(NULL, TRUE);
        $email = $data['email'];
        $username = $email;
        $password = $data['password'];
        $group = array('1'); // Sets user to admin. No need for array('1', '2') as user is always set to member by default
        unset($data['email'], $data['password']);

        if ($this->ion_auth->register($username, $password, $email, $data, $group) )
        {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('users');
        }
        else
        {
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect('users/signup');     
        }
    }

    function login() 
    {
        $identity = $this->input->post('identity');
        $password = $this->input->post('password');
        $remember = TRUE;
        if ($this->ion_auth->login($identity, $password, $remember) )
        {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('users/home');
        }
        else
        {
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect('users');
        }

    }

    function logout() {
        $logout = $this->ion_auth->logout();
        redirect('users');
    }

    function updateinfo($id='') 
    {
        $user = $this->ion_auth->user($id)->row();
        $data['first_name'] = array(
            'name'  => 'first_name',
            'id'    => 'first_name',
            'type'  => 'text',
            'class' => 'form-control',
            'value' => $user->first_name
        );
        $data['last_name'] = array(
            'name'  => 'last_name',
            'id'    => 'last_name',
            'type'  => 'text',
            'class' => 'form-control',
            'value' => $user->last_name
        );
        $data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'type'  => 'email',
            'class' => 'form-control',
            'value' => $user->email
        );
        $data['phone'] = array(
            'name'  => 'phone',
            'id'    => 'phone',
            'type'  => 'phone',
            'class' => 'form-control',
            'value' => $user->phone
        );
        $data['form_location'] = 'users/update/'.$user->id;
        $data['view_file'] = 'updateinfo';
        echo Modules::run('template/admin', $data);
    }

    function update($id) {
        //load validation from application/config/form_validation.php
        if($this->form_validation->run('users/update') == FALSE)
        {
           //$this->session->set_flashdata('message', lang( $this->ion_auth->set_message('update_unsuccessful')) );
            (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            echo Modules::run('users/updateinfo', $id);
        }
        else 
        {
            $data = $this->input->post(NULL, TRUE);
            $this->ion_auth->update($id, $data);
            $flash_message = lang($this->ion_auth->set_message('update_successful'));
            $this->session->set_flashdata('message', $flash_message );
            redirect('users/updateinfo/'.$id);
        }
    }

    function get($order_by) 
    {
        $this->load->model('mdl_users');
        $query = $this->mdl_users->get($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) 
    {
        $this->load->model('mdl_users');
        $query = $this->mdl_users->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) 
    {
        $this->load->model('mdl_users');
        $query = $this->mdl_users->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) 
    {
        $this->load->model('mdl_users');
        $query = $this->mdl_users->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) 
    {
        $this->load->model('mdl_users');
        $this->mdl_users->_insert($data);
    }

    function _update($id, $data) 
    {
        $this->load->model('mdl_users');
        $this->mdl_users->_update($id, $data);
    }

    function _delete($id) 
    {
        $this->load->model('mdl_users');
        $this->mdl_users->_delete($id);
    }

    function count_where($column, $value) 
    {
        $this->load->model('mdl_users');
        $count = $this->mdl_users->count_where($column, $value);
        return $count;
    }

    function get_max() 
    {
        $this->load->model('mdl_users');
        $max_id = $this->mdl_users->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) 
    {
        $this->load->model('mdl_users');
        $query = $this->mdl_users->_custom_query($mysql_query);
        return $query;
    }

}