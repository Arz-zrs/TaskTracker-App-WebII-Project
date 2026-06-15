<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $hashedPassword = password_hash('password', PASSWORD_BCRYPT);

        $users = [
            [
                'id' => 1,
                'name' => 'Arif Wicaksono',
                'email' => 'admin@example.com',
                'password' => $hashedPassword,
                'role' => 'admin',
                'avatar' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => $hashedPassword,
                'role' => 'member',
                'avatar' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'name' => 'Citra Dewi',
                'email' => 'citra@example.com',
                'password' => $hashedPassword,
                'role' => 'member',
                'avatar' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'name' => 'Dimas Prasetyo',
                'email' => 'dimas@example.com',
                'password' => $hashedPassword,
                'role' => 'member',
                'avatar' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'name' => 'PT Maju Bersama',
                'email' => 'klien@example.com',
                'password' => $hashedPassword,
                'role' => 'klien',
                'avatar' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $this->db->table('users')->insertBatch($users);
    }
}
