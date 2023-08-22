<?php

namespace App\Exports;

use App\Models\Pettycash;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PettycashExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(array $params) {
        $this->params = (object) $params;
    }

    public function collection()
    {
        $query = "SELECT pettycash.tgl, pettycash.uraian, kategori.name_kat, pettycash.qty, pettycash.stn, pettycash.harga_stn, pettycash.total, pettycash.cost_center, pettycash.ket FROM pettycash
        LEFT JOIN kategori ON pettycash.kategori_id=id_kat";

        if ($this->params->start_date && $this->params->end_date) {
            $query .= " WHERE pettycash.tgl BETWEEN '{$this->params->start_date} 00:00:00' AND '{$this->params->end_date} 23:59:59'";
        }

        return collect(\DB::select($query));
    }

    public function headings():array{
        return [
            'Tanggal',
            'Uraian',
            'Kategori',
            'Quantity',
            'Satuan',
            'Harga Satuan',
            'Total',
            'Cost Center',
            'Keterangan',
        ];
    }
}
