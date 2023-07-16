<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Carbon\Carbon;

class Laporanmultiplesheet implements WithMultipleSheets
{
    //digunakan untuk export lebih dari 1 tanggal 
    use Exportable;
    protected $date;
    public function __construct($date)
    {
        $this->date = $date;
    }
    public function sheets(): array
    {
        $sheets = [];
        $days = $this->date->daysInMonth;
        for ($day = 1; $day <= $days; $day++) { 
           $date = $this->date->format('Y').'-'.$this->date->format('m').'-'.$day;
           $sheets[] = new LaporanTransaksi(Carbon::createFromDate($date));
       }
           return $sheets;
    }
}
