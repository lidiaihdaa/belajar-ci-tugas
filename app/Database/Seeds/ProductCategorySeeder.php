<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'       => 'ASUS TUF A15 FA506NF',
                'harga'      => 10899000,
                'jumlah'     => 5,
                'foto'       => 'asus_tuf_a15.jpg',
                'kategori'   => 'Laptop Gaming',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama'       => 'Asus Vivobook 14 A1404ZA',
                'harga'      => 6899000,
                'jumlah'     => 7,
                'foto'       => 'asus_vivobook_14.jpg',
                'kategori'   => 'Laptop Tipis',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama'       => 'Lenovo IdeaPad Slim 3-14IAU7',
                'harga'      => 6299000,
                'jumlah'     => 5,
                'foto'       => 'lenovo_ideapad_slim_3.jpg',
                'kategori'   => 'Laptop Entry Level',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama'       => 'HP Pavilion Aero 13-be2002AU',
                'harga'      => 9999000,
                'jumlah'     => 4,
                'foto'       => 'hp_pavilion_aero.jpg',
                'kategori'   => 'Ultrabook',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama'       => 'Dell Inspiron 15 3511',
                'harga'      => 8599000,
                'jumlah'     => 6,
                'foto'       => 'dell_inspiron_15.jpg',
                'kategori'   => 'Laptop Harian',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama'       => 'Acer Aspire 5 Slim A514',
                'harga'      => 6799000,
                'jumlah'     => 3,
                'foto'       => 'acer_aspire_5.jpg',
                'kategori'   => 'Laptop Multimedia',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama'       => 'MacBook Air M1 2020',
                'harga'      => 13999000,
                'jumlah'     => 2,
                'foto'       => 'macbook_air_m1.jpg',
                'kategori'   => 'Laptop Premium',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama'       => 'Microsoft Surface Laptop Go',
                'harga'      => 12499000,
                'jumlah'     => 4,
                'foto'       => 'surface_laptop_go.jpg',
                'kategori'   => 'Ultraportable',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama'       => 'MSI Modern 14 B11MOU',
                'harga'      => 7499000,
                'jumlah'     => 6,
                'foto'       => 'msi_modern_14.jpg',
                'kategori'   => 'Laptop Office',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama'       => 'Axioo MyBook 14F',
                'harga'      => 3899000,
                'jumlah'     => 8,
                'foto'       => 'axioo_mybook_14f.jpg',
                'kategori'   => 'Laptop Budget',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]
        ];

        foreach ($data as $item) {
            $this->db->table('product_category')->insert($item);
        }
    }
}
