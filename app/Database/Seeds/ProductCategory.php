<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductCategory extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'       => 'Laptop',
                'deskripsi'  => 'Berbagai jenis laptop untuk kebutuhan kerja, gaming, dan belajar.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Monitor',
                'deskripsi'  => 'Monitor dengan berbagai ukuran dan resolusi untuk kebutuhan visual.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Speaker',
                'deskripsi'  => 'Speaker berkualitas tinggi untuk pengalaman audio terbaik.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data ke tabel productcategory
        $this->db->table('productcategory')->insertBatch($data);
    }
}
