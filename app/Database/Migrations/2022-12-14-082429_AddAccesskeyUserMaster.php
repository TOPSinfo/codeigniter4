<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAccesskeyUserMaster extends Migration
{
    public function up()
    {
        
        $fields = array(
          'access_key' => array(
            'type' => 'VARCHAR',
            'constraint' => 255,
            'after' => 'created_by'
            )
        ); 
        $this->forge->addColumn('user_master', $fields); 
    }

    public function down()
    {
            $this->forge->drop_column('user_master', 'access_key');

    }
}
