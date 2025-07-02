<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class DiskonController extends BaseController
{
    protected $db;
    protected $diskonTable;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->diskonTable = $this->db->table('tambahdiskon'); // pastikan nama tabel ini sesuai
        helper(['form', 'url']);
    }

    public function index()
    {
        // Hanya admin yang bisa akses
        if (session()->get('role') !== 'admin') {
            throw PageNotFoundException::forPageNotFound();
        }

        $diskon = $this->diskonTable->orderBy('tanggal', 'ASC')->get()->getResult();
        $todayDiskon = $this->diskonTable->where('tanggal', date('Y-m-d'))->get()->getRow();

        // Cek apakah sedang dalam mode edit
        $editData = null;
        if ($this->request->getGet('id')) {
            $editData = $this->diskonTable->where('id', $this->request->getGet('id'))->get()->getRow();
        }

        return view('v_diskon', [
            'diskon' => $diskon,
            'todayDiskon' => $todayDiskon,
            'edit' => $editData,
            'validation' => \Config\Services::validation(),
            'success' => session()->getFlashdata('success'),
            'failed' => session()->getFlashdata('failed'),
        ]);
    }

    public function tambah()
    {
        $tanggal = $this->request->getPost('tanggal');
        $nominal = $this->request->getPost('nominal');

        // Cek jika diskon untuk tanggal yang sama sudah ada
        $cek = $this->diskonTable->where('tanggal', $tanggal)->countAllResults();

        if ($cek > 0) {
            session()->setFlashdata('failed', 'Diskon untuk tanggal tersebut sudah ada!');
        } else {
            $this->diskonTable->insert([
                'tanggal' => $tanggal,
                'nominal' => $nominal,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            session()->setFlashdata('success', 'Diskon berhasil ditambahkan.');
        }

        return redirect()->to('/diskon');
    }

    public function edit()
    {
        $id = $this->request->getPost('id');
        $nominal = $this->request->getPost('nominal');

        if (!$id || !$nominal) {
            return redirect()->to('/diskon');
        }

        $this->diskonTable->where('id', $id)->update(null, [
            'nominal' => $nominal,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('success', 'Diskon berhasil diperbarui.');
        return redirect()->to('/diskon');
    }

    public function hapus($id)
    {
        if ($id) {
            $this->diskonTable->delete(['id' => $id]);
            session()->setFlashdata('success', 'Diskon berhasil dihapus.');
        }

        return redirect()->to('/diskon');
    }
}
