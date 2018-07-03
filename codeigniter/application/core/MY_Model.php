<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of MY_Model
 *
 * @author marwansaleh 10:20:35 AM
 */
class MY_Model extends CI_Model {
    private $_last_message;
    private $_last_inserted_id;
    
    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    protected $_timestamps = FALSE;
    protected $_timestamps_field = array('created'=>'created_on','modified'=>'modified_on');
    protected $_peoplestamp = FALSE;
    protected $_peoplestamp_field = array('created_by');
    protected $_auto_increment = TRUE;
    
    public function getMessage(){
        return $this->_last_message;
    }
    
    public function getLastId() {
        return $this->_last_inserted_id;
    }
    
    public function getTable() {
        return $this->_table_name;
    }
    
    public function getFields() {
        return $this->db->list_fields($this->_table_name);
    }
    
    public function exportCSV($header=TRUE, $filename=NULL, $where=NULL, $limit=0){
        $headers = $this->getFields();
        
        if ($limit > 0){
            $this->db->limit($limit);
        }
        if ($where){
            $this->db->where($where);
        }
        $data = $this->db->get($this->_table_name)->result_array();
        
        $fp = fopen('php://output', 'w');
        if ($fp && $data) {
            if (!$filename) {
                $filename = 'export.csv';
            }
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="'.$filename.'"');
            header('Pragma: no-cache');
            header('Expires: 0');
            if ($header){
                fputcsv($fp, $headers);
            }
            foreach ($data as $row){
                fputcsv($fp, array_values($row));
            }
        }
        fclose($fp);
    }
    
    public function exportQueryCSV($sql, $header=TRUE, $filename=NULL){
        $query = $this->db->query($sql);
        $data = $query->result_array();
        
        $fp = fopen('php://output', 'w');
        if ($fp && $data) {
            if (!$filename) {
                $filename = 'export.csv';
            }
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="'.$filename.'"');
            header('Pragma: no-cache');
            header('Expires: 0');
            if ($header){
                fputcsv($fp, $query->list_fields);
            }
            foreach ($data as $row){
                fputcsv($fp, array_values($row));
            }
        }
        fclose($fp);
    }
    
    public function get($id=NULL) {
        $this->db->from($this->_table_name);
        
        if ($id) {
            $this->db->where($this->_primary_key, $id);
            try {
                return $this->db->get()->row();
            } catch (Exception $ex) {
                $this->_last_message = $ex->getMessage();
                
                return FALSE;
            }
            
        } else {
            if ($this->_order_by){
                $this->db->order_by($this->_order_by);
            }
            
            return $this->db->get()->result();
        }
    }
    
    public function getBy($array=NULL, $field='*', $single=FALSE) {
        
        $this->db->select($field)->from($this->_table_name);
        if ($array) {
            $this->db->where($array);
        }
        
        if (!$single) {
            if ($this->_order_by) {
                $this->db->order_by($this->_order_by);
            }
            $result = $this->db->get()->result();
        } else {
            try {
                $result = $this->db->get()->row();
            } catch (Exception $ex) {
                $this->_last_message = $ex->getMessage();
                
                return FALSE;
            }
        }
        return $result;
    }
    
    public function getCount($array=NULL) {
        if ($array) {
            $this->db->where($array);
        }
        return $this->db->count_all_results($this->_table_name,TRUE);
    }
    
    public function save($data){
        if ($this->_timestamps){
            foreach ($this->_timestamps_field as $val){
                if (!isset($data[$val])){
                    $data[$val] = date('Y-m-d H:i:s');
                }
            }
        }
        if ($this->db->insert($this->_table_name, $data)){
            if ($this->_auto_increment) {
                $this->_last_inserted_id = $this->db->insert_id();
                return $this->db->insert_id();
            } else {
                return TRUE;
            }
        } else {
            //get error message from last database query
            $error = $this->db->error();
            $this->_last_message = $error['message'];
            
            return FALSE;
        }
        
    }
    
    public function saveBatch($data) {
        $this->db->insert_batch($this->_table_name, $data);
        log_message('debug', json_encode($data));
        //no return value
    }
    
    public function update($id, $data, $escape = TRUE) {
        foreach ($data as $key => $value) {
            $this->db->set($key, $value, $escape);
        }
        $this->db->where($this->_primary_key, $id);
        
        if($this->db->update($this->_table_name)){
            return TRUE;
        } else {
            //get error message from last database query
            $error = $this->db->error();
            $this->_last_message = $error['message'];
            
            return FALSE;
        }
    }
    
    public function replace($data) {
        if ($this->db->replace($this->_table_name, $data)) {
            return TRUE;
        } else {
            //get error message from last database query
            $error = $this->db->error();
            $this->_last_message = $error['message'];
            
            return FALSE;
        }
    }
    
    public function updateBy($array, $data) {
        $this->db->where($array);
        
        if($this->db->update($this->_table_name, $data)){
            return TRUE;
        } else {
            //get error message from last database query
            $error = $this->db->error();
            $this->_last_message = $error['message'];
            
            return FALSE;
        }
    }
    
    public function delete($id) {
        if ($this->db->delete($this->_table_name, array($this->_primary_key => $id))){
            return TRUE;
        } else {
            //get error message from last database query
            $error = $this->db->error();
            $this->_last_message = $error['message'];
            
            return FALSE;
        }
    }
    
    public function deleteBy($array) {
        $this->db->where($array);
        if ($this->db->delete($this->_table_name)) {
            return $this->db->affected_rows();
        } else {
            //get error message from last database query
            $error = $this->db->error();
            $this->_last_message = $error['message'];
            
            return FALSE;
        }
    }
    
    public function truncate() {
        if ($this->db->truncate($this->_table_name)) {
            return TRUE;
        } else {
            //get error message from last database query
            $error = $this->db->error();
            $this->_last_message = $error['message'];
            
            return FALSE;
        }
    }
}

/**
 * Filename : MY_Model.php
 * Location : /core/MY_Model.php
 */
