<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author IT01
 */
class Home extends MY_Controller {
    
    public function index($event_name=NULL) {
        $event = $this->get_event($event_name);
        
        if (!$event) {
            $view_name = '';
        } else {
            $view_name = '';
        }
        
        $this->load->view('_layout_main', $this->data);
    }
}

/**
 * Filename : Home.php
 * Location : /controllers/Home.php
 */