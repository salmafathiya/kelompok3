<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use Dompdf\Dompdf; // Don't forget to add this use statement

class TransaksiController extends BaseController
{
    protected $cart;
    protected $client;
    protected $apiKey;
    protected $transaction;
    protected $transaction_detail;

    function __construct()
    {
        helper(['number', 'form', 'url']); // Combined helpers
        $this->cart = \Config\Services::cart();
        $this->client = new \GuzzleHttp\Client();
        $this->apiKey = env('COST_KEY');
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
    }

    // ... [Keep all your existing methods until the buy() method] ...

    public function transaksi() // Add this method for transaction listing
    {
        $data['transactions'] = $this->transaction->findAll();
        return view('v_transaksi', $data);
    }

    public function downloadTransaksi()
    {
        // Get all transactions with their details
        $transactions = $this->transaction->findAll();
        
        // Format currency helper
        helper('number');
        
        $data = [
            'transactions' => $transactions,
            'tanggal_cetak' => date('d-m-Y H:i:s')
        ];
        
        $html = view('v_transaksiPDF', $data);

        // Instantiate Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output the generated PDF
        $dompdf->stream('laporan-transaksi-' . date('Ymd-His') . '.pdf');
    }
}