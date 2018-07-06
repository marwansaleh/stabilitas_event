<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_create_ref_events
 *
 * @author marwansaleh
 */
class Migration_create_ref_events extends MY_Migration {
    protected $_table_name = 'ref_events';
    protected $_primary_key = 'ev_id';
    protected $_index_keys = array();
    protected $_fields = array(
        'ev_id'    => array (
            'type'  => 'INT',
            'NULL' => FALSE
        ),
        'ev_title'    => array(
            'type' => 'VARCHAR',
            'constraint' => 254,
            'NULL' => FALSE
        ),
        'ev_name' => array(
            'type'  => 'VARCHAR',
            'constraint' => 150,
            'NULL' => FALSE
        ),
        'ev_ui_path' => array(
            'type' => 'VARCHAR',
            'constraint' => 254,
            'NULL' => TRUE
        ),
        'ev_start_date' => array(
            'type' => 'DATE',
            'NULL' => FALSE
        ),
        'ev_end_date' => array(
            'type' => 'DATE',
            'NULL' => FALSE
        ),
        'ev_active' => array(
            'type' => 'TINYINT',
            'constraint' => 1,
            'default' => 0
        ),
    );
}

/*
 * filename : 002_create_ref_events.php
 * location : /application/migrations/002_create_ref_events.php
 */
