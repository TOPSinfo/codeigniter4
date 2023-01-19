<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = [
            'name'     => 'Admin User',
            'email'    => 'admin@yopmail.com',
            'password' =>'$2y$10$F8fmsB.hN4JkgSs2Cji5XeMHcSPHECNvRygX0aWIHYeUN9j/X4knW',
            'is_admin'  => 1,
            'is_deleted'=>0
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO user_master (name, email, password, is_admin,is_deleted) VALUES(:name:, :email:, :password:, :is_admin:, :is_deleted: )', $data);

        // Using Query Builder
        $this->db->table('user_master')->insert($data);
    }
}
