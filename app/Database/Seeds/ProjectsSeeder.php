<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $projects = [
            [
                'id' => 1,
                'title' => 'Redesign Website Company Profile',
                'description' => 'Pembaruan tampilan website perusahaan dengan desain modern dan responsif menggunakan Tailwind CSS.',
                'admin_id' => 1,
                'status' => 'active',
                'archived_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'title' => 'Aplikasi Kasir Toko',
                'description' => 'Sistem point-of-sale sederhana untuk toko retail dengan fitur inventaris dan laporan penjualan harian.',
                'admin_id' => 1,
                'status' => 'active',
                'archived_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'title' => 'Migrasi Server Lama',
                'description' => 'Pemindahan semua layanan dari server lama ke VPS baru dengan konfigurasi Nginx + Docker.',
                'admin_id' => 1,
                'status' => 'completed',
                'archived_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-30 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
            ],
        ];

        $this->db->table('projects')->insertBatch($projects);
    }
}
