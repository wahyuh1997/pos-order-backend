<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    function get_all_order()
    {
        $model = new Pesanan();

        return $this->return_success('',$model->get_pesanan());
    }
    
    function get_order($id)
    {
        $model = new Pesanan();

        return $this->return_success('',$model->get_pesanan($id));
    }

    function insert_order(Request $request){
        $model = new Pesanan();

        $data = $this->get_field_pesanan_request($request);
        $data['no_order'] = $model->create_no_pesanan();
        $pesanan = Pesanan::create($data);
    
        return $this->return_success('Menu berhasil ditambahkan!', $model->get_pesanan($pesanan->id));
    }

    private function get_field_pesanan_request($request)
    {
        $data = [
            'nama_pelanggan' => $request->nama_pelanggan,
            'meja_id' => $request->meja_id,
        ];

        return $data;
    }
}
