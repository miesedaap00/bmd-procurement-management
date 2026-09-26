<?php

namespace App\Services;

use App\Models\Quotation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class QuotationPdfService
{
    public function generate(Quotation $quotation): string
    {
        $quotation->load('items');

        $pdf = Pdf::loadView(
            'quotations.pdf',
            [
                'quotation' => $quotation,
            ]
        );

        $pdf->setPaper('A4', 'portrait');

        $directory = 'quotations';

        Storage::disk('local')->makeDirectory(
            $directory
        );

        $safeFileName = preg_replace(
            '/[^A-Za-z0-9._-]+/',
            '_',
            $quotation->quotation_number
        );

        $fileName = $safeFileName . '.pdf';

        $filePath = $directory . '/' . $fileName;

        $absolutePath = Storage::disk('local')->path(
            $filePath
        );

        $pdf->save($absolutePath);

        return $filePath;
    }
}