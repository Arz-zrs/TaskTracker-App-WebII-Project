<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CommentsSeeder extends Seeder
{
    public function run()
    {
        $comments = [
            // Task 1: Wireframe
            [
                'task_id' => 1,
                'user_id' => 3, 
                'body' => 'Wireframe sudah selesai, silakan direview pak. Ada 5 versi alternatif layout.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-8 days')),
            ],
            [
                'task_id' => 1,
                'user_id' => 1, 
                'body' => 'Bagus, pakai versi ke-3. Warna header disesuaikan dengan brand guideline ya.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
            ],
            [
                'task_id' => 1,
                'user_id' => 3,
                'body' => 'Siap, sudah disesuaikan. Task ini bisa ditandai selesai.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
            ],

            // Task 2: Hero & Navbar
            [
                'task_id' => 2,
                'user_id' => 2, 
                'body' => 'Navbar sudah responsif. Sekarang lagi ngerjain animasi hero section.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
            [
                'task_id' => 2,
                'user_id' => 1,
                'body' => 'Oke, jangan lupa tambahkan smooth scroll ke setiap anchor link.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 days')),
            ],

            // Task 6: Halaman transaksi
            [
                'task_id' => 6,
                'user_id' => 2, 
                'body' => 'Fitur pilih produk sudah jalan. Sekarang lagi integrasi logika kembalian.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            [
                'task_id' => 6,
                'user_id' => 4, 
                'body' => 'Kalau butuh referensi struktur datanya bisa lihat di tabel transactions yang aku buat kemarin.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],

            // Task 8: Setup VPS 
            [
                'task_id' => 8,
                'user_id' => 4,
                'body' => 'VPS sudah up, Nginx sudah dikonfigurasi dengan SSL dari Let\'s Encrypt.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-21 days')),
            ],
        ];

        $this->db->table('comments')->insertBatch($comments);
    }
}
