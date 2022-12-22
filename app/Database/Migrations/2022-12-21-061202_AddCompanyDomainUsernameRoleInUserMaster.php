<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCompanyDomainUsernameRoleInUserMaster extends Migration
{
    public function up()
    {
        $fields = array(
          'username' => array(
            'type' => 'VARCHAR',
            'constraint' => 255,
            'after' => 'email'
            ),
          'company'=>array(
            'type' => 'VARCHAR',
            'constraint' => 255,
            'after' => 'profile_pic'
          ),
          'domains'=>array(
            'type' => 'text',
            'after' => 'company'
          ),
          'billing_term'=>array(
            'type' => 'VARCHAR',
            'constraint' => 255,
            'after' => 'domains'
          ),
          'role'=>array(
            'type' => 'VARCHAR',
            'constraint' => 255,
            'after' => 'billing_term'
          ),
        ); 
        $this->forge->addColumn('user_master', $fields); 
    }

    public function down()
    {
        $this->forge->drop_column('user_master', 'username');
        $this->forge->drop_column('user_master', 'company');
        $this->forge->drop_column('user_master', 'domains');
        $this->forge->drop_column('user_master', 'billing_term');
        $this->forge->drop_column('user_master', 'role');
    }
}
