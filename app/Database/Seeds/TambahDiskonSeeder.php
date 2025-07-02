<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TambahDiskonSeeder extends Seeder
{
    public function run()
    {
        $tanggalAwal = '2025-06-25'; // Sesuai data Anda
        $nominalList = [100000, 200000, 300000, 100000, 200000, 100000, 200000, 300000, 100000, 100000];

        for ($i = 0; $i < 10; $i++) {
            $tanggal = date('Y-m-d', strtotime("+$i days", strtotime($tanggalAwal)));

            $data = [
                'tanggal'    => $tanggal,
                'nominal'    => $nominalList[$i],
                'created_at' => '2025-06-25 06:01:35',
                'updated_at' => null, // sesuai gambar Anda
            ];

            $this->db->table('TambahDiskon')->insert($data);
        }
    }
}