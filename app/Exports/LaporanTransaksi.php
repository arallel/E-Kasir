<?php

namespace App\Exports;

use App\Models\transaksi_barang;
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
use Maatwebsite\Excel\Concerns\WithTitle;

//phpoffice
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Border;


class LaporanTransaksi  implements FromCollection,ShouldAutoSize,WithCustomStartCell,WithStyles, WithMapping,WithHeadings,WithTitle
{
    //digunakan untuk export 1 tanggal
    protected $date;
    protected $no;
    protected $data;
    public function __construct($date)
    {
        $this->date = $date;
        $this->no = 1;
        $this->data = detail_transaksi::with('databarang', 'transaksi', 'transaksi.user')
        ->join('transaksi_barang', 'transaksi_barang.id_transaksi', '=', 'detail_transaksi.id_transaksi')
        ->whereDate('tgl_transaksi', $this->date->format('Y-m-d'))
        ->orderBy('no_transaksi');
    }
    public function collection()
    {
        return $this->data->get();    
    }
    public function title(): string
    {
        return 'Tanggal ' .$this->date->isoFormat('D MMMM');
    }
    public function styles(Worksheet $sheet)
    {
        $total = $this->data->sum('harga_item');
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $startCell = 'A5';
        $endCell = $highestColumn . $highestRow;

        $highestColumnCoordinate = Coordinate::columnIndexFromString($highestColumn);
        $footercell = 'A' . ($highestRow + 1);
        $endfootercell = 'O' . ($highestRow + 1);
        $sheet->getStyle('A1:O3')
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle('A4:O5')
            ->getFont()
            ->setBold(true)
            ->setSize(12);

        $sheet->getStyle($footercell.':'.$endfootercell)
              ->getFont()
              ->setBold(true)
              ->setSize(13);

        $sheet->getStyle('A1:O3')
              ->getFill()
              ->setFillType(Fill::FILL_SOLID)
              ->getStartColor()
              ->setARGB('b3c6e7'); // Blue color

        $sheet->getStyle($footercell.':'.$endfootercell)
              ->getFill()
              ->setFillType(Fill::FILL_SOLID)
              ->getStartColor()
              ->setARGB('b3c6e7'); // Blue color 

        $sheet->getStyle('A5:O5')
              ->getFill()
              ->setFillType(Fill::FILL_SOLID)
              ->getStartColor()
              ->setARGB('b3c6e7'); // Blue color
        
        $sheet->mergeCells('A1:O1');
        $sheet->mergeCells('A2:O2');
        $sheet->mergeCells('A3:O3');
        $sheet->mergeCells('A4:O4');
        $sheet->mergeCells($footercell.':'.$endfootercell);

        $sheet->setCellValue('A1', 'LAPORAN PENJUALAN HARIAN');
        $sheet->setCellValue('A2', 'BULAN '.strtoupper($this->date->isoFormat('MMMM Y')));
        $sheet->setCellValue('A3', 'PRINCESS SYAFA SHOP');
        $sheet->setCellValue('A4', 'Tanggal : '.strtoupper($this->date->isoFormat('D MMMM Y')));
        $sheet->setCellValue($footercell, 'Total Penjualan : Rp.'.str_replace(',', '.', number_format($total)));

        $sheet->getStyle($startCell . ':' . $endCell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle($footercell . ':' . $endfootercell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $sheet->getStyle($startCell . ':' . $endfootercell)
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

        $sheet->getStyle('A1:O3')
              ->getAlignment()
              ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return $sheet;
    }
      public function startCell(): string
    {
        return 'A5';
    }
     public function map($detailtransaksi): array
    {
        return [
            $this->no++,
            $detailtransaksi->transaksi->no_transaksi,
            $detailtransaksi->id_barang,
            $detailtransaksi->databarang->nama_barang,
            $detailtransaksi->qty,
            'PCS',
            'Rp.' . str_replace(',', '.', number_format($detailtransaksi->harga_asli)),
            'Rp.' . str_replace(',', '.', number_format($detailtransaksi->harga_item)),

            ($detailtransaksi->jumlah_diskon_rp)?'Rp.'.str_replace(',', '.', number_format($detailtransaksi->jumlah_diskon_rp)):'-',
            ($detailtransaksi->jumlah_diskon_persen)?$detailtransaksi->jumlah_diskon_persen.'%':'-',
            $detailtransaksi->transaksi->user->nama_pengguna,
            $detailtransaksi->transaksi->tgl_transaksi.'/'.$detailtransaksi->transaksi->waktu_transaksi,
            ($detailtransaksi->transaksi->no_pesanan)?$detailtransaksi->transaksi->no_pesanan:'-',
            ($detailtransaksi->transaksi->no_resi)?$detailtransaksi->transaksi->no_resi:'-',
            $detailtransaksi->transaksi->pembelian,

        ];
    }
     public function headings(): array
    {
        return [
            'No', 
            'Nomer Transaksi', 
            'Kode Barang', 
            'Nama Barang', 
            'Qty', 
            'Satuan', 
            'Harga Normal', 
            'Jumlah', 
            'Potongan Harga', 
            'Diskon', 
            'Nama Kasir', 
            'Tanggal & Jam Transaksi', 
            'Nomer Pesanan', 
            'Nomer Resi', 
            'Keterangan', 
        ];
    }
}
