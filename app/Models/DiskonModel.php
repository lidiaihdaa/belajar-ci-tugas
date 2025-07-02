<?php

namespace App\Models;

use CodeIgniter\Model;

class DiskonModel extends Model
{
    // BARIS INI ADALAH SOLUSINYA
    // Secara eksplisit memberi tahu model ini untuk menggunakan tabel 'tambahdiskon'
    protected $table            = 'tambahdiskon';

    // Properti lainnya tetap sama
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['tanggal', 'nominal'];
    protected $useTimestamps    = true;
}