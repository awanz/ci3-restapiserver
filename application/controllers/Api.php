<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct()
    {
        parent::__construct();
        $this->load->model('EmployeesModel');
    }

    public function employees_get()
    {
        $id = $this->get('id');

        if ( $id === null )
        {
            $employees = $this->EmployeesModel->all();
            if ($employees)
            {
                $this->response( [
                    'status' => true,
                    'message' => 'List employees',
                    'data' => $employees
                ], 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No employees were found'
                ], 404 );
            }
        }
        else
        {
            $employees = $this->EmployeesModel->find($id);
            if ($employees)
            {
                $this->response( [
                    'status' => true,
                    'message' => 'List employees',
                    'data' => $employees
                ], 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such employee found'
                ], 404 );
            }
        }
    }

    function employees_post() {
        $data = $this->post();

        $insert = $this->EmployeesModel->insert($data);

        if ($insert) {
            $this->response( [
                'status' => false,
                'message' => 'Insert successfully.',
                'data' => $data
            ], 200 );
        } else {
            $this->response( [
                'status' => false,
                'message' => 'Insert failed.'
            ], 404 );
        }
    }

    function employees_put() {
        $id = $this->get('id');
        $data = $this->put();

        $update = $this->EmployeesModel->update($id, $data);

        if ($update) {
            $this->response( [
                'status' => false,
                'message' => 'Update successfully.',
                'data' => $data
            ], 200 );
        } else {
            $this->response( [
                'status' => false,
                'message' => 'Update failed.'
            ], 404 );
        }
    }

    function employees_delete() {
        $id = $this->delete('id');

        $delete = $this->EmployeesModel->delete($id);
        if ($delete) {
            $this->response( [
                'status' => false,
                'message' => 'Delete successfully.'
            ], 200 );
        } else {
            $this->response( [
                'status' => false,
                'message' => 'Delete failed.'
            ], 404 );
        }
    }
}