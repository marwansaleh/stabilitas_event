<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author IT01
 */
class MY_Controller extends CI_Controller {
    protected $data = [];
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_event($event_name=NULL) {
        //$this->load->model(array(''));
        return FALSE;
    }
}

/**
 * Filename : MY_Controller.php
 * Location : /core/MY_Controller.php
 */