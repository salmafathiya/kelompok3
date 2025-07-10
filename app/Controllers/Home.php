<?php

namespace App\Controllers;

use App\Models\ProductModel; 
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class Home extends BaseController
{
    protected $product;
    protected $transaction;
    protected $transaction_detail;

    function __construct()
    {
        helper('form');
        helper('number');
        $this->product = new ProductModel();
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
    }

    public function index()
    {
        $product = $this->product->findall();
        $data['product'] = $product;

        return view('v_home', $data);
    }

    public function profile()
{
    $username = session()->get('username');
    $data['username'] = $username;

    $buy = $this->transaction->where('username', $username)->findAll();
    $data['buy'] = $buy;

    $product = [];

    if (!empty($buy)) {
        foreach ($buy as $item) {
            $detail = $this->transaction_detail->select('transaction_detail.*, product.nama, product.harga, product.foto')->join('product', 'transaction_detail.product_id=product.id')->where('transaction_id', $item['id'])->findAll();

            if (!empty($detail)) {
                $product[$item['id']] = $detail;
            }
        }
    }

    $data['product'] = $product;

    return view('v_profile', $data);
}

    public function transaksi()
{
    $username = session()->get('username');
    $role = session()->get('role');

    if ($role === 'admin') {
        $buy = $this->transaction->findAll();
    } else {
        $buy = $this->transaction->where('username', $username)->findAll();
    }

    $product = [];

    if (!empty($buy)) {
        foreach ($buy as $item) {
            $detail = $this->transaction_detail->select('transaction_detail.*, product.nama, product.harga, product.foto')->join('product', 'transaction_detail.product_id=product.id')->where('transaction_id', $item['id'])->findAll();

            if (!empty($detail)) {
                $product[$item['id']] = $detail;
            }
        }
    }
    
    $data['buy'] = $buy; //
    $data['product'] = $product;
    $data['title'] = 'Daftar Transaksi';
    $data['tanggal_sekarang'] = date('l, d-m-Y H:i:s'); // Format: Friday, 20-06-2025 10:57:30

    return view('v_transaksi', $data);
}
    public function penjualan()
    {
        $transactions = $this->transaction->findAll(); // ambil semua transaksi

        $data['transactions'] = $transactions;

        return view('v_penjualan', $data); // kirim data ke view
    }

    public function uploadBukti($id)
    {
        $transaction = $this->transaction->find($id);
        if (!$transaction || $transaction['username'] !== session()->get('username')) {
            return redirect()->back()->with('error', 'Transaksi tidak valid!');
        }


        $file = $this->request->getFile('bukti_pembayaran');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $id . '_' . time() . '.' . $file->getExtension();
            $uploadPath = FCPATH . 'bukti/'; // FCPATH = public/
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $file->move($uploadPath, $newName);
            $this->transaction->update($id, ['bukti_pembayaran' => $newName]);
            return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload!');
        } else {
            return redirect()->back()->with('error', 'Upload gagal! Pastikan file gambar valid.');
        }
    }
}
