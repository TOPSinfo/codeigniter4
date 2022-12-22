<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserMaster extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
              
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
               
            ],
            'contact_no' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
               
            ],
            'profile_pic' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
               
            ],
            'is_admin' => [
                'type'       => 'TINYINT',
                'constraint' => '1',
               
            ],
            'is_deleted' => [
                'type'       => 'TINYINT',
                'constraint' => '1',
               
            ],
            'created_by' => [
                'type'       => 'TINYINT',
                'constraint' => '1',
               
            ],
            
            'updated_at' => [
                'type'    => 'DATETIME',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user_master');
    }

    public function down()
    {
        $this->forge->dropTable('user_master');

    }
}
