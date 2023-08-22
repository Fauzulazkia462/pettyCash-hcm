<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PettycashinPettycashExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(array $params) {
        $this->params = (object) $params;
    }

    public function collection()
    {
        $query = "SELECT  'Debit' As jenis, a.tgl, a.uraian, b.name_kat, a.qty, a.stn, a.harga_stn, a.total, a.cost_center, a.ket, b.id_kat
                FROM pettycash a
                LEFT JOIN kategori b ON a.kategori_id = b.id_kat";
                if ($this->params->start_date && $this->params->end_date) {
                    $query .= " WHERE a.tgl BETWEEN '{$this->params->start_date} 00:00:00' AND '{$this->params->end_date} 23:59:59'";
                    
                }
                
        $query .= "UNION ALL
                SELECT  'Kredit' As jenis, c.tgl, c.uraian, NULL AS name_kat, NULL AS qty, NULL AS stn, NULL AS harga_stn, c.total, NULL AS cost_center, c.ket, NULL AS id_kat
                FROM pettycash_in c";
                if ($this->params->start_date && $this->params->end_date) {
                    $query .= " WHERE c.tgl BETWEEN '{$this->params->start_date} 00:00:00' AND '{$this->params->end_date} 23:59:59'";
                }

        return collect(\DB::select($query));
    }

    public function headings():array{
        return [
            
            'Jenis',
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
