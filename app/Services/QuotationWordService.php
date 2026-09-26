<?php

namespace App\Services;

use App\Models\Quotation;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class QuotationWordService
{
    public function generate(Quotation $quotation): string
    {
        $quotation->load('items');

        $templatePath = base_path(
            'resources/templates/QUOTATION_BIMADAYA.docx'
        );

        if (!file_exists($templatePath)) {
            throw new \RuntimeException(
                'Template Quotation tidak ditemukan.'
            );
        }

        $templateProcessor = new TemplateProcessor(
            $templatePath
        );

        $templateProcessor->setValue(
            'quotation_number',
            $quotation->quotation_number
        );

        $templateProcessor->setValue(
            'quotation_date',
            $quotation->quotation_date->translatedFormat('d F Y')
        );

        $templateProcessor->setValue(
            'client_name',
            $quotation->client_name
        );

        $templateProcessor->setValue(
            'client_address',
            $quotation->client_address
        );

        $templateProcessor->cloneRow(
            'no',
            $quotation->items->count()
        );

        foreach ($quotation->items as $index => $item) {

            $row = $index + 1;

            $templateProcessor->setValue(
                "no#{$row}",
                $index + 1
            );

            $templateProcessor->setValue(
                "item#{$row}",
                $item->item
            );

            $templateProcessor->setValue(
                "specification#{$row}",
                $item->specification ?? '-'
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
                "price#{$row}",
                $this->formatCurrency($item->price)
            );

            $templateProcessor->setValue(
                "total#{$row}",
                $this->formatCurrency($item->total)
            );

            $templateProcessor->setValue(
                "note#{$row}",
                $item->note ?? '-'
            );
        }

        $directory = 'quotations';

        Storage::disk('local')->makeDirectory(
            $directory
        );

        $safeFileName = preg_replace(
            '/[^A-Za-z0-9._-]+/',
            '_',
            $quotation->quotation_number
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

    private function formatNumber($value): string
    {
        return number_format(
            (float) $value,
            2,
            ',',
            '.'
        );
    }

    private function formatCurrency($value): string
    {
        return number_format(
            (float) $value,
            2,
            ',',
            '.'
        );
    }
}