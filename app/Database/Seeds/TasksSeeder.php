<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TasksSeeder extends Seeder
{
    public function run()
    {
        $tasks = [
            //  Proyek 1: Redesign Website 
            [
                'id' => 1,
                'project_id' => 1,
                'title' => 'Buat wireframe halaman utama',
                'description' => 'Desain wireframe low-fidelity untuk halaman landing page dan about us.',
                'created_by' => 1, 
                'assignee_id' => 3,
                'status' => 'done',
                'priority' => 'high',
                'deadline' => date('Y-m-d', strtotime('-5 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-14 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
                'archived_at' => null,
            ],
            [
                'id' => 2,
                'project_id' => 1,
                'title' => 'Implementasi halaman Hero & Navbar',
                'description' => 'Coding section hero dengan animasi dan navbar responsif menggunakan Tailwind CSS.',
                'created_by' => 1,
                'assignee_id' => 2, 
                'status' => 'in_progress',
                'priority' => 'high',
                'deadline' => date('Y-m-d', strtotime('+3 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 days')),
                'archived_at' => null,
            ],
            [
                'id' => 3,
                'project_id' => 1,
                'title' => 'Integrasi form kontak ke backend',
                'description' => 'Sambungkan form kontak di frontend ke endpoint CI4 dan kirim notifikasi email.',
                'created_by' => 1,
                'assignee_id' => 2, 
                'status' => 'todo',
                'priority' => 'medium',
                'deadline' => date('Y-m-d', strtotime('+10 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'archived_at' => null,
            ],
            [
                'id' => 4,
                'project_id' => 1,
                'title' => 'Testing cross-browser & responsivitas',
                'description' => 'Uji tampilan di Chrome, Firefox, Safari, dan perangkat mobile.',
                'created_by' => 1,
                'assignee_id' => null, 
                'status' => 'todo',
                'priority' => 'low',
                'deadline' => date('Y-m-d', strtotime('+14 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'archived_at' => null,
            ],

            //  Proyek 2: Aplikasi Kasir 
            [
                'id' => 5,
                'project_id' => 2,
                'title' => 'Setup database produk & kategori',
                'description' => 'Buat migrasi dan seeder untuk tabel produk, kategori, dan satuan.',
                'created_by' => 1,
                'assignee_id' => 4, 
                'status' => 'done',
                'priority' => 'high',
                'deadline' => date('Y-m-d', strtotime('-10 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-20 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-11 days')),
                'archived_at' => null,
            ],
            [
                'id' => 6,
                'project_id' => 2,
                'title' => 'Halaman transaksi penjualan',
                'description' => 'UI input transaksi: scan barcode, pilih produk, hitung kembalian.',
                'created_by' => 1,
                'assignee_id' => 2,
                'status' => 'in_progress',
                'priority' => 'high',
                'deadline' => date('Y-m-d', strtotime('+5 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'archived_at' => null,
            ],
            [
                'id' => 7,
                'project_id' => 2,
                'title' => 'Laporan penjualan harian & bulanan',
                'description' => 'Generate laporan dengan filter tanggal dan export ke PDF.',
                'created_by' => 1,
                'assignee_id' => 4, 
                'status' => 'todo',
                'priority' => 'medium',
                'deadline' => date('Y-m-d', strtotime('+20 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
                'archived_at' => null,
            ],

            //  Proyek 3: Migrasi Server 
            [
                'id' => 8,
                'project_id' => 3,
                'title' => 'Setup VPS dan konfigurasi Nginx',
                'description' => 'Provisioning VPS baru, install Nginx, dan konfigurasi virtual host.',
                'created_by' => 1,
                'assignee_id' => 4, 
                'status' => 'done',
                'priority' => 'high',
                'deadline' => date('Y-m-d', strtotime('-20 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-30 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-20 days')),
                'archived_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
            ],
            [
                'id' => 9,
                'project_id' => 3,
                'title' => 'Migrasi database dan backup',
                'description' => 'Dump database lama, import ke server baru, verifikasi integritas data.',
                'created_by' => 1,
                'assignee_id' => 3, 
                'status' => 'done',
                'priority' => 'high',
                'deadline' => date('Y-m-d', strtotime('-15 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-28 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-15 days')),
                'archived_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
            ],
        ];

        $this->db->table('tasks')->insertBatch($tasks);

    }
}
