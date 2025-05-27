<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Redirect implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah ini request POST dari login
        if (session()->has('isLoggedIn') && current_url() === base_url('auth/login')) {
            // Arahkan user ke halaman produk
            return redirect()->to('/contact');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu diisi untuk kasus ini
    }
}