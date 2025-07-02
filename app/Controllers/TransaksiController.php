<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class TransaksiController extends BaseController
{
    protected $cart;
    protected $client;
    protected $apiKey;
    protected $transaction;
    protected $transaction_detail;

    public function __construct()
    {
        helper(['number', 'form']);
        $this->cart = \Config\Services::cart();
        $this->client = new \GuzzleHttp\Client();
        $this->apiKey = env('COST_KEY');
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
    }

    public function index()
    {
        $data['items'] = $this->cart->contents();
        $data['total'] = $this->cart->total();
        return view('v_keranjang', $data);
    }

    public function cart_add()
    {
        $produkId   = $this->request->getPost('id');
        $nama       = $this->request->getPost('nama');
        $hargaAsli  = (int) $this->request->getPost('harga');
        $foto       = $this->request->getPost('foto');
        $jumlah     = 1;

        // Ambil diskon dari session
        $diskon = session()->get('diskon') ?? 0;
        $hargaDiskon = max(0, $hargaAsli - $diskon);

        $this->cart->insert([
            'id'      => $produkId,
            'qty'     => $jumlah,
            'price'   => $hargaDiskon,
            'name'    => $nama,
            'options' => [
                'harga_asli' => $hargaAsli,
                'diskon'     => $diskon,
                'foto'       => $foto,
                'subtotal_asli' => $hargaAsli * $jumlah,
                'subtotal_diskon' => $hargaDiskon * $jumlah
            ]
        ]);

        session()->setFlashdata('success', 'Produk berhasil ditambahkan ke keranjang. (<a href="' . base_url('keranjang') . '">Lihat</a>)');
        return redirect()->to(base_url('/'));
    }

    public function cart_clear()
    {
        $this->cart->destroy();
        session()->setFlashdata('success', 'Keranjang berhasil dikosongkan.');
        return redirect()->to(base_url('keranjang'));
    }

    public function cart_edit()
    {
        $i = 1;
        foreach ($this->cart->contents() as $item) {
            $this->cart->update([
                'rowid' => $item['rowid'],
                'qty'   => $this->request->getPost('qty' . $i++)
            ]);
        }

        session()->setFlashdata('success', 'Keranjang berhasil diedit.');
        return redirect()->to(base_url('keranjang'));
    }

    public function cart_delete($rowid)
    {
        $this->cart->remove($rowid);
        session()->setFlashdata('success', 'Produk berhasil dihapus dari keranjang.');
        return redirect()->to(base_url('keranjang'));
    }

    public function checkout()
    {
        $data['items'] = $this->cart->contents();
        $data['total'] = $this->cart->total();

        return view('v_checkout', $data);
    }

    public function getLocation()
    {
        $search = $this->request->getGet('search');

        $response = $this->client->request('GET', 'https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search=' . $search . '&limit=50', [
            'headers' => [
                'accept' => 'application/json',
                'key' => $this->apiKey,
            ],
        ]);

        $body = json_decode($response->getBody(), true);
        return $this->response->setJSON($body['data']);
    }

    public function getCost()
    {
        $destination = $this->request->getGet('destination');

        $response = $this->client->request('POST', 'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
            'multipart' => [
                ['name' => 'origin', 'contents' => '64999'],
                ['name' => 'destination', 'contents' => $destination],
                ['name' => 'weight', 'contents' => '1000'],
                ['name' => 'courier', 'contents' => 'jne'],
            ],
            'headers' => [
                'accept' => 'application/json',
                'key' => $this->apiKey,
            ],
        ]);

        $body = json_decode($response->getBody(), true);
        return $this->response->setJSON($body['data']);
    }

    public function buy()
    {
        if ($this->request->getPost()) {
            $dataForm = [
                'username' => $this->request->getPost('username'),
                'total_harga' => $this->request->getPost('total_harga'),
                'alamat' => $this->request->getPost('alamat'),
                'ongkir' => $this->request->getPost('ongkir'),
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $this->transaction->insert($dataForm);
            $last_insert_id = $this->transaction->getInsertID();

            foreach ($this->cart->contents() as $item) {
                $dataFormDetail = [
                    'transaction_id' => $last_insert_id,
                    'product_id' => $item['id'],
                    'jumlah' => $item['qty'],
                    'diskon' => $item['options']['diskon'] ?? 0,
                    'subtotal_harga' => $item['subtotal'],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
                $this->transaction_detail->insert($dataFormDetail);
            }

            $this->cart->destroy();

            return redirect()->to(base_url());
        }
    }
}
