<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PettycashExport;
use App\Exports\PettycashinExport;
use App\Exports\PettycashinPettycashExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class ExportController extends Controller
{
    public function index(){
        return view('export.index');
    }

    public function exportexcel(Request $req){
        $req->validate([
            'start_date' => 'bail|nullable|date',
            'end_date' => 'bail|nullable|date',
        ]);

        $params = [
            'start_date' => $req->start_date,
            'end_date' => $req->end_date
        ];
        // return $params;
        return Excel::download(new PettycashExport($params), 'PettyCashDebit-'.date('d-m-Y').'.xlsx');
    }

    public function exportinexcel(Request $req){
        $req->validate([
            'start_date' => 'bail|nullable|date',
            'end_date' => 'bail|nullable|date',
        ]);

        $params = [
            'start_date' => $req->start_date,
            'end_date' => $req->end_date
        ];
        return Excel::download(new PettycashinExport($params), 'PettyCashKredit-'.date('d-m-Y').'.xlsx');
    }

    public function exportallexcel(Request $req){
        $req->validate([
            'start_date' => 'bail|nullable|date',
            'end_date' => 'bail|nullable|date',
        ]);

        $params = [
            'start_date' => $req->start_date,
            'end_date' => $req->end_date
        ];

        return Excel::download(new PettycashinPettycashExport($params), 'PettyCash-'.date('d-m-Y').'.xlsx');
    }
}
