<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Models\DiskonModel;

class Home extends BaseController
{
    protected $product;
    protected $transaction;
    protected $transaction_detail;
     protected $diskon;

    public function __construct()
    {
        helper('form');
        helper('number');
        $this->product = new ProductModel();
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
         $this->diskon = new DiskonModel();
    }

   public function index()
    {
        $product = $this->product->findAll();
        $data['product'] = $product;

        // Cek diskon aktif hari ini
        $today = date('Y-m-d');
        $diskon = $this->diskon->where('tanggal', $today)->first();

        if ($diskon) {
            session()->set('diskon', $diskon['nominal']);
        } else {
            session()->remove('diskon');
        }

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

    public function faq()
    {
        return view('v_faq');
    }

    public function contact()
    {
        return view('v_contact');
    }

     public function diskon()
    {
        $today = date('Y-m-d');
        $diskon = $this->diskon->where('tanggal_mulai <=', $today)
                               ->where('tanggal_selesai >=', $today)
                               ->findAll();

        $data['diskon'] = $diskon;

        return view('v_diskon', $data);
    }
}
