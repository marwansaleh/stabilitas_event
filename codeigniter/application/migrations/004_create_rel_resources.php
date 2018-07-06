<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_create_rel_resources
 *
 * @author marwansaleh
 */
class Migration_create_rel_resources extends MY_Migration {
    protected $_table_name = 'rel_resources';
    protected $_primary_key = 'res_id';
    protected $_index_keys = array();
    protected $_fields = array(
        'res_id'    => array (
            'type'  => 'INT',
            'NULL' => FALSE
        ),
        'ev_id'    => array(
            'type' => 'INT',
            'NULL' => FALSE
        ),
        'res_type' => array(
            'type'  => 'ENUM("picture","document","video","audio")'
        ),
        'res_title' => array(
            'type' => 'VARCHAR',
            'constraint' => 100,
            'NULL' => FALSE
        ),
        'res_public' => array(
            'type' => 'TINYINT',
            'constraint' => 1,
            'default' => 1
        ),
        'res_file_name' => array(
            'type' => 'VARCHAR',
            'constraint' => 100,
            'NULL' => FALSE
        ),
        'res_alt_url' => array(
            'type' => 'VARCHAR',
            'constraint' => 254,
            'NULL' => TRUE
        )
    );
}

/*
 * filename : 004_create_rel_resources.php
 * location : /application/migrations/004_create_rel_resources.php
 */
