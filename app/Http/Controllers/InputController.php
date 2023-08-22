<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function index(){
        $kategori = \DB::table('kategori')
        ->select('kategori.*')
        ->get(); 

        return view('input.index', compact('kategori'));
    }

    public function insert(Request $req){

        $inputHarga = $req->harga_stn;
        $inputTotal = $req->total;

        $HargaSatuan = str_replace(".", "", $inputHarga);
        $Total = str_replace(".", "", $inputTotal);

        $filename = $req->file->getClientOriginalName();
        $req->file->move('uploads/kwitansi/', $filename);

        \DB::table('pettycash')
        ->insert([
            'tgl' => $req->tgl,
            'uraian' => $req->uraian,
            'kategori_id' => $req->kategori_id,
            'qty' => $req->qty,
            'stn' => $req->stn,
            'harga_stn' => $HargaSatuan,
            'total' => $Total,
            'cost_center' => $req->cost_center,
            'ket' => $req->ket,
            'filename' => $filename,
        ]);

        return back()->with('message', [
            'type' => 'Berhasil diinput!',
            'msg' => 'Berhasil!',
        ]);
    }
    public function insertKredit(Request $req){
        
        $total = str_replace(".", "", $req->totalKredit);

        \DB::table('pettycash_in')
        ->insert([
            'tgl' => $req->tglKredit,
            'uraian' => $req->uraianKredit,
            'total' => $total,
            'ket' => $req->ketKredit,
        ]);

        return back()->with('message', [
            'type' => 'Berhasil diinput!',
            'msg' => 'Berhasil!',
        ]);
    }
}
