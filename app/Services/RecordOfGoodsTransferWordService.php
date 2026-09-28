<?php

namespace App\Services;

use App\Models\RecordOfGoodsTransfer;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class RecordOfGoodsTransferWordService
{
    public function generate(
        RecordOfGoodsTransfer $record
    ): string {
        $record->load('items');

        $templatePath = base_path(
            'resources/templates/BAST_BIMADAYA.docx'
        );

        if (!file_exists($templatePath)) {
            throw new \RuntimeException(
                'Template Record of Goods Transfer tidak ditemukan.'
            );
        }

        $templateProcessor = new TemplateProcessor(
            $templatePath
        );

        $date = $record->transfer_date;

        $templateProcessor->setValue(
            'record_number',
            $record->record_number
        );

        $templateProcessor->setValue(
            'hari',
            $this->getDayName($date)
        );

        $templateProcessor->setValue(
            'tanggal',
            $date->format('d')
        );

        $templateProcessor->setValue(
            'bulan',
            $this->getMonthName($date)
        );

        $templateProcessor->setValue(
            'tahun',
            $date->format('Y')
        );

        $templateProcessor->setValue(
            'recipient_name',
            $record->recipient_name
        );

        $templateProcessor->setValue(
            'recipient_position',
            $record->recipient_position
        );

        $templateProcessor->setValue(
            'recipient_company',
            $record->recipient_company
        );

        $templateProcessor->cloneRow(
            'no',
            $record->items->count()
        );

        foreach ($record->items as $index => $item) {
            $row = $index + 1;

            $templateProcessor->setValue(
                "no#{$row}",
                $index + 1
            );

            $templateProcessor->setValue(
                "nama_barang#{$row}",
                $item->nama_barang
            );

            $templateProcessor->setValue(
                "brand#{$row}",
                $item->brand ?? '-'
            );

            $templateProcessor->setValue(
                "quantity#{$row}",
                $this->formatNumber($item->quantity)
            );

            $templateProcessor->setValue(
                "satuan#{$row}",
                $item->satuan
            );

            $templateProcessor->setValue(
                "kondisi#{$row}",
                $item->kondisi
            );
        }

        $directory = 'record-of-goods-transfers';

        Storage::disk('local')->makeDirectory(
            $directory
        );

        $safeFileName = preg_replace(
            '/[^A-Za-z0-9._-]+/',
            '_',
            $record->record_number
        );

        $fileName = $safeFileName . '.docx';

        $filePath = $directory . '/' . $fileName;

        $absolutePath = Storage::disk('local')->path(
            $filePath
        );

        $templateProcessor->saveAs(
            $absolutePath
        );

        return $filePath;
    }

    private function getDayName($date): string
    {
        $days = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];

        return $days[$date->dayOfWeek];
    }

    private function getMonthName($date): string
    {
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $months[$date->month];
    }

    private function formatNumber($value): string
    {
        $number = (float) $value;

        if ($number == floor($number)) {
            return number_format(
                $number,
                0,
                ',',
                '.'
            );
        }

        return number_format(
            $number,
            2,
            ',',
            '.'
        );
    }
}