<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_create_session
 *
 * @author marwansaleh
 */
class Migration_create_session extends MY_Migration {
    protected $_table_name = 'sessions';
    protected $_primary_key = 'id';
    protected $_index_keys = array('ip_address');
    protected $_fields = array(
        'id'    => array (
            'type'  => 'VARCHAR',
            'constraint' => 40,
            'NULL' => FALSE
        ),
        'ip_address'    => array(
            'type' => 'VARCHAR',
            'constraint' => 45,
            'NULL' => FALSE
        ),
        'timestamp' => array(
            'type'  => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,
            'default' => 0,
            'NULL' => FALSE
        ),
        'data' => array(
            'type' => 'TEXT',
            'NULL' => FALSE
        )
    );
}

/*
 * filename : 001_create_session.php
 * location : /application/migrations/001_create_session.php
 */
