<?php

namespace App\Exports;

use App\Models\databarang;
use App\Models\detail_transaksi;
use App\Models\kategory;
use Carbon\Carbon;
use DB;

//maatwebsiet
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

//phpoffice
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Border;

class databarangexport implements FromCollection,ShouldAutoSize,WithCustomStartCell,WithStyles, WithMapping,WithHeadings
{
    protected $no;
    protected $data;
    public function __construct()
    {
        $this->no = 1;
        $this->data = databarang::with('kategory');
    }
    public function collection()
    {
        return $this->data->get();    
    }
    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $startCell = 'A4';
        $endCell = $highestColumn . $highestRow;
        $sheet->getStyle('A1:J3')
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle('A4:J4')
            ->getFont()
            ->setBold(true)
            ->setSize(12);


        $sheet->getStyle('A1:J2')
              ->getFill()
              ->setFillType(Fill::FILL_SOLID)
              ->getStartColor()
              ->setARGB('b3c6e7'); // Blue color

        $sheet->getStyle('A4:J4')
              ->getFill()
              ->setFillType(Fill::FILL_SOLID)
              ->getStartColor()
              ->setARGB('b3c6e7'); // Blue color
        
        $sheet->mergeCells('A1:J1');
        $sheet->mergeCells('A2:J2');
        $sheet->mergeCells('A3:J3');

        $sheet->setCellValue('A1', 'DATA BARANG');
        $sheet->setCellValue('A2', 'PRINCESS SYAFA SHOP');


        $sheet->getStyle($startCell . ':' . $endCell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle($startCell . ':' . $endCell)
            ->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
                'font' => [
                    'size' => 12,
                ],
            ]);

        $sheet->getStyle('A1:J3')
              ->getAlignment()
              ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return $sheet;
    }
      public function startCell(): string
    {
        return 'A4';
    }
     public function map($databarang): array
    {
        return [
            $this->no++,
            $databarang->id_barang,
            $databarang->nama_barang,
            $databarang->kategory->nama_kategory,
            $databarang->harga_barang,
            $databarang->harga_pembelian,
            $databarang->stok,
            $databarang->barcode,
            $databarang->status_barang,
            ($databarang->foto_barang)?$databarang->foto_barang:'-',

        ];
    }
     public function headings(): array
    {
        return [
            'No', 
            'Id Barang',
            'Nama Barang',
            'Kategory',
            'Harga Barang',
            'Harga Pembelian',
            'Stok',
            'Barcode',
            'Status Barang',
            'Foto Barang',
        ];
    }
}
