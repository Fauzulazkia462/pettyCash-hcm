<?php

namespace App\Exports;

use App\Models\PettycashIn;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PettycashinExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(array $params) {
        $this->params = (object) $params;
    }

    public function collection()
    {
        $query = "SELECT pettycash_in.tgl, pettycash_in.uraian, pettycash_in.total, pettycash_in.ket FROM pettycash_in";

        if ($this->params->start_date && $this->params->end_date) {
            $query .= " WHERE pettycash_in.tgl BETWEEN '{$this->params->start_date} 00:00:00' AND '{$this->params->end_date} 23:59:59'";
        }

        return collect(\DB::select($query));
    }

    public function headings():array{
        return [
            'Tanggal',
            'Uraian',
            'Total',
            'Keterangan',
        ];
    }
}
