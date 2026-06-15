<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProjectMembersSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $members = [
            // Proyek 1: Redesign Website
            ['project_id' => 1, 'user_id' => 2, 'role' => 'member', 'joined_at' => $now],
            ['project_id' => 1, 'user_id' => 3, 'role' => 'member', 'joined_at' => $now],
            ['project_id' => 1, 'user_id' => 5, 'role' => 'klien', 'joined_at' => $now], 

            // Proyek 2: Aplikasi Kasir
            ['project_id' => 2, 'user_id' => 2, 'role' => 'member', 'joined_at' => $now], 
            ['project_id' => 2, 'user_id' => 4, 'role' => 'member', 'joined_at' => $now], 
            ['project_id' => 2, 'user_id' => 5, 'role' => 'klien', 'joined_at' => $now], 

            // Proyek 3: Migrasi Server (sudah archived)
            ['project_id' => 3, 'user_id' => 3, 'role' => 'member', 'joined_at' => date('Y-m-d H:i:s', strtotime('-30 days'))],
            ['project_id' => 3, 'user_id' => 4, 'role' => 'member', 'joined_at' => date('Y-m-d H:i:s', strtotime('-30 days'))],
        ];

        $this->db->table('project_members')->insertBatch($members);
    }
}
