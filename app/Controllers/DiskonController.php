<?php

namespace App\Controllers;

use App\Models\DiskonModel;
use CodeIgniter\Controller;

class DiskonController extends BaseController
{
    protected $diskonModel;

    public function __construct()
    {
        helper(['form', 'number']);
        $this->diskonModel = new DiskonModel();
    }

    public function index()
    {
        $data['diskon'] = $this->diskonModel->findAll();
        return view('v_diskon', $data);
    }

    public function create()
    {
        return view('diskon/create');
    }

   public function store()
{
    $tanggal = $this->request->getPost('tanggal');
    $nominal = $this->request->getPost('nominal');

    // Validasi tanggal unik
    $existing = $this->diskonModel->where('tanggal', $tanggal)->first();
    if ($existing) {
        return redirect()->to('/diskon')->with('failed', 'Diskon dengan tanggal tersebut sudah ada.');
    }

    $this->diskonModel->save([
        'tanggal' => $tanggal,
        'nominal' => $nominal,
    ]);

    return redirect()->to('/diskon')->with('success', 'Diskon berhasil ditambahkan');
}


    public function edit($id)
    {
        $data['diskon'] = $this->diskonModel->find($id);
        return view('diskon/edit', $data);
    }

    public function update($id)
{
    $tanggal = $this->request->getPost('tanggal');
    $nominal = $this->request->getPost('nominal');

    // Validasi: pastikan tanggal tidak digunakan oleh ID lain
    $existing = $this->diskonModel
        ->where('tanggal', $tanggal)
        ->where('id !=', $id)
        ->first();

    if ($existing) {
        return redirect()->to('/diskon')->with('failed', 'Tanggal sudah digunakan oleh diskon lain.');
    }

    $this->diskonModel->update($id, [
        'tanggal' => $tanggal,
        'nominal' => $nominal,
    ]);

    return redirect()->to('/diskon')->with('success', 'Diskon berhasil diperbarui');
}


    public function delete($id)
    {
        $this->diskonModel->delete($id);
        return redirect()->to('/diskon')->with('success', 'Diskon berhasil dihapus');
    }

    
}
