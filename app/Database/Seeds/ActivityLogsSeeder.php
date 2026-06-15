<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ActivityLogsSeeder extends Seeder
{
    public function run()
    {
        $logs = [
            // Proyek dibuat
            [
                'user_id' => 1,
                'project_id' => 1,
                'entity_type' => 'project',
                'entity_id' => 1,
                'action' => 'created',
                'detail' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-14 days')),
            ],
            [
                'user_id' => 1,
                'project_id' => 2,
                'entity_type' => 'project',
                'entity_id' => 2,
                'action' => 'created',
                'detail' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-20 days')),
            ],

            // Task dibuat
            [
                'user_id' => 1,
                'project_id' => 1,
                'entity_type' => 'task',
                'entity_id' => 1,
                'action' => 'created',
                'detail' => 'Buat wireframe halaman utama',
                'created_at' => date('Y-m-d H:i:s', strtotime('-14 days')),
            ],
            [
                'user_id' => 1,
                'project_id' => 1,
                'entity_type' => 'task',
                'entity_id' => 2,
                'action' => 'created',
                'detail' => 'Implementasi halaman Hero & Navbar',
                'created_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
            ],
            [
                'user_id' => 1,
                'project_id' => 2,
                'entity_type' => 'task',
                'entity_id' => 5,
                'action' => 'created',
                'detail' => 'Setup database produk & kategori',
                'created_at' => date('Y-m-d H:i:s', strtotime('-20 days')),
            ],

            // Update status task
            [
                'user_id' => 3, 
                'project_id' => 1,
                'entity_type' => 'task',
                'entity_id' => 1,
                'action' => 'status_changed',
                'detail' => 'status: todo -> in_progress',
                'created_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
            ],
            [
                'user_id' => 3,
                'project_id' => 1,
                'entity_type' => 'task',
                'entity_id' => 1,
                'action' => 'status_changed',
                'detail' => 'status: in_progress -> done',
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
            ],
            [
                'user_id' => 2, 
                'project_id' => 1,
                'entity_type' => 'task',
                'entity_id' => 2,
                'action' => 'status_changed',
                'detail' => 'status: todo -> in_progress',
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
            ],
            [
                'user_id' => 4, 
                'project_id' => 2,
                'entity_type' => 'task',
                'entity_id' => 5,
                'action' => 'status_changed',
                'detail' => 'status: todo -> in_progress',
                'created_at' => date('Y-m-d H:i:s', strtotime('-15 days')),
            ],
            [
                'user_id' => 4,
                'project_id' => 2,
                'entity_type' => 'task',
                'entity_id' => 5,
                'action' => 'status_changed',
                'detail' => 'status: in_progress -> done',
                'created_at' => date('Y-m-d H:i:s', strtotime('-11 days')),
            ],

            // Anggota ditambahkan
            [
                'user_id' => 1,
                'project_id' => 1,
                'entity_type' => 'member',
                'entity_id' => 2, 
                'action' => 'created',
                'detail' => 'Budi Santoso ditambahkan sebagai member',
                'created_at' => date('Y-m-d H:i:s', strtotime('-14 days')),
            ],
            [
                'user_id' => 1,
                'project_id' => 1,
                'entity_type' => 'member',
                'entity_id' => 5, 
                'action' => 'created',
                'detail' => 'PT Maju Bersama ditambahkan sebagai klien',
                'created_at' => date('Y-m-d H:i:s', strtotime('-13 days')),
            ],

            // Proyek diarsip
            [
                'user_id' => 1,
                'project_id' => 3,
                'entity_type' => 'project',
                'entity_id' => 3,
                'action' => 'archived',
                'detail' => 'Proyek selesai dan diarsipkan',
                'created_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
            ],

            // Komentar ditambahkan
            [
                'user_id' => 3,
                'project_id' => 1,
                'entity_type' => 'comment',
                'entity_id' => 1,
                'action' => 'created',
                'detail' => 'Komentar pada task: Buat wireframe halaman utama',
                'created_at' => date('Y-m-d H:i:s', strtotime('-8 days')),
            ],
            [
                'user_id' => 2,
                'project_id' => 1,
                'entity_type' => 'comment',
                'entity_id' => 4,
                'action' => 'created',
                'detail' => 'Komentar pada task: Implementasi halaman Hero & Navbar',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
        ];

        $this->db->table('activity_logs')->insertBatch($logs);

    }
}
