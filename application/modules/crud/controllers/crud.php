<?php

error_reporting(E_ALL);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud extends CI_Controller {

    private $em;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('doctrine');
        $this->em = $this->doctrine->em;
    }

    public function index()
    {
        $data['loadpage'] = 'index';
        $data['users'] = $this->em->getRepository('Entity\User')->findAll();
        $this->load->view('layout', $data);
    }

    public function edit($id)
    {
        $data['loadpage'] = 'edit';

        $user = $this->em->getRepository('Entity\User')->find($id);
        $usergroups = $this->em->getRepository('Entity\UserGroup')->findAll();

        if (!$user) {
            throw new Exception('No User Found');
        }

        $data['user'] = $user;
        $data['usergroups'] = $usergroups;

        if ($this->input->post('submitBtn')) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', "required|min_length[6]|max_length[32]|callback_username_check[$id]");
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');

            $this->form_validation->set_rules('group', 'Group', 'required');

            if ($this->form_validation->run()) {
                $group = $this->em->getRepository('Entity\UserGroup')->find($this->input->post('group'));

                $user->setUsername($this->input->post('username'));
                $user->setEmail($this->input->post('email'));
                $user->setGroup($group);

                try {
                    $this->em->persist($user);
                    $this->em->flush();

                    $this->session->set_flashdata('success', 'Data has been successfully updated');
                    redirect('crud');
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
        $this->load->view('layout', $data);
    }

    public function add()
    {
        $data['loadpage'] = 'add';

        $usergroups = $this->em->getRepository('Entity\UserGroup')->findAll();

        $data['usergroups'] = $usergroups;

        if ($this->input->post('submitBtn')) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|max_length[32]|callback_username_check');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[30]');
            $this->form_validation->set_rules('group', 'Group', 'required');

            if ($this->form_validation->run()) {
                $group = $this->em->getRepository('Entity\UserGroup')->find($this->input->post('group'));

                $user = new Entity\User();
                $user->setUsername($this->input->post('username'));
                $user->setEmail($this->input->post('email'));
                $user->setPassword($this->input->post('password'));
                $user->setGroup($group);

                try {
                    $this->em->persist($user);
                    $this->em->flush();

                    $this->session->set_flashdata('success', 'Data has been successfully added');
                    redirect('crud');
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
        $this->load->view('layout', $data);
    }

    public function username_check($str)
    {
        if ($id = $this->input->post('hidden_id')) {
            $query = $this->em->createQuery("SELECT u FROM Entity\User u WHERE u.id != $id");
            $users = $query->getResult();
        }
        else {
            $users = $this->em->getRepository('Entity\User')->findAll();
        }
        foreach ($users as $user) {
            if ($user->getUsername() == trim($str)) {
                $this->form_validation->set_message('username_check', 'The %s is not available');
                return FALSE;
            }
        }

        return TRUE;
    }

    public function email_check($str)
    {
        if ($id = $this->input->post('hidden_id')) {
            $query = $this->em->createQuery("SELECT u FROM Entity\User u WHERE u.id != $id");
            $users = $query->getResult();
        }
        else {
            $users = $this->em->getRepository('Entity\User')->findAll();
        }


        foreach ($users as $user) {
            if ($user->getEmail() == trim($str)) {
                $this->form_validation->set_message('email_check', 'The %s is not available');
                return FALSE;
            }
        }
        return TRUE;
    }

    public function delete($id)
    {
        $user = $this->em->getRepository('Entity\User')->find($id);

        $this->em->remove($user);
        $this->em->flush();
        $this->session->set_flashdata('success', 'Data has been successfully deleted');
        redirect('crud');
    }

}
