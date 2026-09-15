<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class LabaSpreadsheetExport
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function download($filename = 'laporan-laba.xlsx')
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // ============================
        // JUDUL
        // ============================
        $sheet->setCellValue('A1', 'LAPORAN LABA');
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A2', 'Congek Bakes - Bakery Store');
        $sheet->mergeCells('A2:F2');
        $sheet->getStyle('A2')->getFont()->setSize(11)->setItalic(true);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A3', 'Tanggal Export: ' . date('d-m-Y H:i'));
        $sheet->mergeCells('A3:F3');
        $sheet->getStyle('A3')->getFont()->setSize(10);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // ============================
        // HEADER (baris 5)
        // ============================
        $headers = [
            'Kode Barang',
            'Nama Produk',
            'Total Terjual',
            'Modal (Harga Beli)',
            'Penjualan (Harga Jual)',
            'Untung',
        ];

        $sheet->fromArray($headers, null, 'A5');

        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '6B4D38'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
            ],
        ];

        $sheet->getStyle('A5:F5')->applyFromArray($headerStyle);
        $sheet->getRowDimension(5)->setRowHeight(26);

        // ============================
        // DATA (mulai baris 6)
        // ============================
        $row = 6;
        $totalTerjual = 0;
        $totalModal = 0;
        $totalJual = 0;
        $totalUntung = 0;

        foreach ($this->data as $item) {
            $sheet->setCellValue('A' . $row, $item->kode_produk);
            $sheet->setCellValue('B' . $row, $item->nama_produk);
            $sheet->setCellValue('C' . $row, $item->total_terjual);
            $sheet->setCellValue('D' . $row, $item->total_modal);
            $sheet->setCellValue('E' . $row, $item->total_jual);
            $sheet->setCellValue('F' . $row, $item->total_untung);

            // Format angka jadi Rupiah
            $sheet->getStyle('D' . $row)->getNumberFormat()->setFormatCode('"Rp" #,##0');
            $sheet->getStyle('E' . $row)->getNumberFormat()->setFormatCode('"Rp" #,##0');
            $sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode('"Rp" #,##0');

            // Alignment
            $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('C' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $totalTerjual += $item->total_terjual;
            $totalModal += $item->total_modal;
            $totalJual += $item->total_jual;
            $totalUntung += $item->total_untung;

            $row++;
        }

        // ============================
        // TOTAL (baris terakhir)
        // ============================
        $sheet->setCellValue('A' . $row, 'TOTAL');
        $sheet->mergeCells('A' . $row . ':B' . $row);
        $sheet->setCellValue('C' . $row, $totalTerjual);
        $sheet->setCellValue('D' . $row, $totalModal);
        $sheet->setCellValue('E' . $row, $totalJual);
        $sheet->setCellValue('F' . $row, $totalUntung);

        $sheet->getStyle('D' . $row)->getNumberFormat()->setFormatCode('"Rp" #,##0');
        $sheet->getStyle('E' . $row)->getNumberFormat()->setFormatCode('"Rp" #,##0');
        $sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode('"Rp" #,##0');

        $totalStyle = [
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => '6B4D38']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'F5EFE8'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];
        $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray($totalStyle);

        // ============================
        // BORDER
        // ============================
        $sheet->getStyle('A5:F' . $row)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'E8DED3'],
                ],
            ],
        ]);

        // ============================
        // AUTO SIZE
        // ============================
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Freeze header
        $sheet->freezePane('A6');

        // ============================
        // OUTPUT
        // ============================
        $writer = new Xlsx($spreadsheet);

        if (ob_get_contents()) {
            ob_end_clean();
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
