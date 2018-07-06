<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_create_rel_participants
 *
 * @author marwansaleh
 */
class Migration_create_rel_participants extends MY_Migration {
    protected $_table_name = 'rel_participants';
    protected $_primary_key = 'par_id';
    protected $_index_keys = array();
    protected $_fields = array(
        'par_id'    => array (
            'type'  => 'INT',
            'NULL' => FALSE
        ),
        'ev_id'    => array(
            'type' => 'INT',
            'NULL' => FALSE
        ),
        'par_name' => array(
            'type'  => 'VARCHAR',
            'constraint' => 50,
            'NULL' => FALSE
        ),
        'par_email' => array(
            'type' => 'VARCHAR',
            'constraint' => 50,
            'NULL' => FALSE
        ),
        'par_mobile' => array(
            'type' => 'VARCHAR',
            'constraint' => 15,
            'NULL' => FALSE
        ),
        'par_company' => array(
            'type' => 'VARCHAR',
            'constraint' => 100,
            'NULL' => FALSE
        ),
        'par_position' => array(
            'type' => 'VARCHAR',
            'constraint' => 50,
            'NULL' => FALSE
        ),
        'par_reg_no' => array(
            'type' => 'VARCHAR',
            'constraint' => 30,
            'NULL' => TRUE
        )
    );
}

/*
 * filename : 003_create_rel_participants.php
 * location : /application/migrations/003_create_rel_participants.php
 */
