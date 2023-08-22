<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pettycash;
use App\Models\PettycashIn;
// use Illuminate\Support\Facades\Auth;
use Auth;

class HomeController extends Controller
{
    public function index(){

        // $userId = auth()->user()->users->id;
        $userId = Auth::user();

        $data = \DB::table('pettycash')
        ->leftjoin('kategori', 'pettycash.kategori_id', '=', 'kategori.id_kat')
        ->select('pettycash.*', 'kategori.*')
        ->get();

        $data2 = \DB::table('pettycash_in')
        ->select('pettycash_in.*')
        ->get();

        // $datah = "SELECT a.id, a.tgl, a.uraian, b.name_kat, a.qty, a.stn, a.harga_stn, a.total, a.cost_center, a.ket, b.id_kat
        //         FROM pettycash a
        //         LEFT JOIN kategori b ON a.kategori_id = b.id_kat
                
        //         UNION ALL
                
        //         SELECT c.id, c.tgl, c.uraian, NULL AS name_kat, NULL AS qty, NULL AS stn, NULL AS harga_stn, c.total, NULL AS cost_center, c.ket, NULL AS id_kat
        //         FROM pettycash_in c";

        // $data = \DB::select($datah);

        $users = \DB::table('users')
        ->select('users.*')
        ->where('users.id', '=', $userId->id)
        ->get();

        $kategori = \DB::table('kategori')
        ->select('kategori.*')
        ->get(); 

        // $totaldebit = "SELECT SUM(total) FROM pettycash";
        // $totalkredit = "SELECT SUM(total) FROM pettycash_in";

        // $totalDbt = \DB::select($totaldebit);
        // $totalKrd = \DB::select($totalkredit);
        $totalDbt = \DB::table('pettycash')
        ->sum('pettycash.total');

        $totalKrd = \DB::table('pettycash_in')
        ->sum('pettycash_in.total');

        $total = $totalKrd-$totalDbt;
        // $total = str_replace("-", "", $totalY);

        // return $totalDbt;
        // $total = $totalDbt-$totalKrd;

        // $total = $totalkredit-$totaldebit;

        // return $userId;

        return view('home.index', compact('data', 'users', 'kategori', 'data2', 'totalDbt', 'totalKrd', 'total'));
    }
    public function update(Request $req){
        $id = $req->idEdit;

        $HargaSatuan = str_replace(".", "", $req->harga_stnEdit);
        $Total = str_replace(".", "", $req->totalEdit);

        $model = Pettycash::find($id);
        $model->tgl = $req->tglEdit;
        $model->uraian = $req->uraianEdit;
        $model->kategori_id = $req->kategori_idEdit;
        $model->qty = $req->qtyEdit;
        $model->stn = $req->stnEdit;
        $model->harga_stn = $HargaSatuan;
        $model->total = $Total;
        $model->cost_center = $req->cost_centerEdit;
        $model->ket = $req->ketEdit;
        $model->save();

        return back()->with('message', [
            'type' => 'Berhasil diedit!',
            'msg' => 'Berhasil!',
        ]);
    }

    public function updateKredit(Request $req){
        $id = $req->idEdit;

        $HargaSatuan = str_replace(".", "", $req->harga_stnEdit);
        $Total = str_replace(".", "", $req->totalEdit);

        $model = PettycashIn::find($id);
        $model->tgl = $req->tglEdit;
        $model->uraian = $req->uraianEdit;
        $model->total = $Total;
        $model->ket = $req->ketEdit;
        $model->save();

        return back()->with('message', [
            'type' => 'Berhasil diedit!',
            'msg' => 'Berhasil!',
        ]);
    }

    public function delete(Request $req){
        $id = $req->idDel;
        \DB::delete('DELETE FROM pettycash WHERE id = ?', [$id]);

        return back()->with('hapus',[
            'type' => 'Berhasil dihapus!',
            'msg' => 'Berhasil Dihapus!',
        ]);
    }

    public function deleteKredit(Request $req){
        $id = $req->idDel;
        \DB::delete('DELETE FROM pettycash_in WHERE id = ?', [$id]);

        return back()->with('hapus',[
            'type' => 'Berhasil dihapus!',
            'msg' => 'Berhasil Dihapus!',
        ]);

    }
}
