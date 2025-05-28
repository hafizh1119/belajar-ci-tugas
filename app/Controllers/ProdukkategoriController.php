<?php

namespace App\Controllers;

use App\Models\ProductCategoryModel;

class ProdukkategoriController extends BaseController
{
    protected $productCategory;

    public function __construct()
    {
        $this->productCategory = new ProductCategoryModel();
    }

    public function index()
    {
        $data['productcategory'] = $this->productCategory->findAll();
        return view('v_produk_category', $data);
    }

    public function create()
    {
        $this->productCategory->save([
            'nama'       => $this->request->getPost('nama'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect('produk-kategori')->with('success', 'Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $this->productCategory->update($id, [
            'nama'       => $this->request->getPost('nama'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect('produk-kategori')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $this->productCategory->delete($id);
        return redirect('produk-kategori')->with('success', 'Data Berhasil Dihapus');
    }
}
