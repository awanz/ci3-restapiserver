<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeesModel extends CI_Model {
    public function all(){
        return $this->db->get('employees')->result_array();
	}
    
    public function find($id){
        $data = $this->db->get_where('employees', array('emp_no' => $id));
        return $data->first_row();
    }
    
    public function insert($data)
	{
        $this->db->insert('employees', $data);
        
        if ($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function update($id, $data)
	{        
        $this->db->where('emp_no', $id);
        $this->db->update('employees', $data);
        
        if ($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function delete($id)
	{       
        $this->db->where('emp_no', $id);
        $delete = $this->db->delete('employees');
        
        if ($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}