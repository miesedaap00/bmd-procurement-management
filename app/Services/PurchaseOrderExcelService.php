<?php

namespace App\Services;

use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PurchaseOrderExcelService
{
    public function generate(PurchaseOrder $purchaseOrder): string
    {
        $templatePath = base_path('resources/templates/PO_BIMADAYA.xlsx');

        if (!file_exists($templatePath)) {
            throw new \RuntimeException('Template Purchase Order tidak ditemukan.');
        }

        $spreadsheet = IOFactory::load($templatePath);

        $worksheet = $spreadsheet->getSheet(1);

        $this->fillHeader($worksheet, $purchaseOrder);
        $this->prepareItemRows($worksheet, $purchaseOrder);
        $this->fillItems($worksheet, $purchaseOrder);
        $this->fillSummary($worksheet, $purchaseOrder);

        $directory = 'purchase-orders';

        Storage::disk('local')->makeDirectory($directory);

        $safeFileName = preg_replace(
            '/[^A-Za-z0-9._-]+/',
            '_',
            $purchaseOrder->po_number
        );

        $fileName = $safeFileName . '.xlsx';
        $filePath = $directory . '/' . $fileName;

        $absolutePath = Storage::disk('local')->path($filePath);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($absolutePath);

        return $filePath;
    }

    private function fillHeader(
        Worksheet $worksheet,
        PurchaseOrder $purchaseOrder
    ): void {
        $worksheet->setCellValue(
            'D7',
            $purchaseOrder->po_number
        );

        $worksheet->setCellValue(
            'B13',
            $purchaseOrder->vendor_name
        );

        $worksheet->setCellValue(
            'B14',
            $purchaseOrder->vendor_address
        );

        $worksheet->setCellValue(
            'J11',
            ': ' . $purchaseOrder->po_date->format('d/m/Y')
        );

        $worksheet->setCellValue(
            'J13',
            ': ' . $purchaseOrder->currency
        );
    }

    private function prepareItemRows(
        Worksheet $worksheet,
        PurchaseOrder $purchaseOrder
    ): void {
        $startRow = 21;
        $defaultEndRow = 26;
        $defaultItemCount = 6;
        $itemCount = $purchaseOrder->items->count();

        if ($itemCount <= $defaultItemCount) {
            return;
        }

        $rowsToInsert = $itemCount - $defaultItemCount;

        $worksheet->insertNewRowBefore(
            27,
            $rowsToInsert
        );

        for ($row = 27; $row < 27 + $rowsToInsert; $row++) {
            $sourceRow = 26;

            $worksheet->copyRowDimensions(
                $sourceRow,
                $row
            );

            $this->copyRowStyle(
                $worksheet,
                $sourceRow,
                $row
            );

            $this->mergeItemDescriptionRow(
                $worksheet,
                $row
            );
        }
    }

    private function copyRowStyle(
        Worksheet $worksheet,
        int $sourceRow,
        int $targetRow
    ): void {
        for ($column = 1; $column <= 10; $column++) {
            $sourceCell = $worksheet->getCellByColumnAndRow(
                $column,
                $sourceRow
            );

            $targetCell = $worksheet->getCellByColumnAndRow(
                $column,
                $targetRow
            );

            $targetCell->setXfIndex(
                $sourceCell->getXfIndex()
            );
        }
    }

    private function mergeItemDescriptionRow(
        Worksheet $worksheet,
        int $row
    ): void {
        $worksheet->mergeCells(
            "B{$row}:D{$row}"
        );
    }

    private function fillItems(
        Worksheet $worksheet,
        PurchaseOrder $purchaseOrder
    ): void {
        $startRow = 21;
        $lastTemplateRow = 26;

        foreach ($purchaseOrder->items as $index => $item) {
            $row = $startRow + $index;

            $worksheet->setCellValue(
                "A{$row}",
                $index + 1
            );

            $worksheet->setCellValue(
                "B{$row}",
                $item->description
            );

            $worksheet->setCellValue(
                "E{$row}",
                $item->quantity
            );

            $worksheet->setCellValue(
                "F{$row}",
                $item->unit
            );

            $worksheet->setCellValue(
                "I{$row}",
                $item->price
            );

            $worksheet->setCellValue(
                "J{$row}",
                $item->quantity * $item->price
            );

            $worksheet->getStyle(
                "I{$row}:J{$row}"
            )
                ->getNumberFormat()
                ->setFormatCode('#,##0.00');
        }

        $itemCount = $purchaseOrder->items->count();

        if ($itemCount < 6) {
            for ($row = $startRow + $itemCount; $row <= $lastTemplateRow; $row++) {
                $worksheet->setCellValue("A{$row}", null);
                $worksheet->setCellValue("B{$row}", null);
                $worksheet->setCellValue("E{$row}", null);
                $worksheet->setCellValue("F{$row}", null);
                $worksheet->setCellValue("I{$row}", null);
                $worksheet->setCellValue("J{$row}", null);
            }
        }
    }

    private function fillSummary(
        Worksheet $worksheet,
        PurchaseOrder $purchaseOrder
    ): void {
        $itemCount = $purchaseOrder->items->count();

        $summaryStartRow = 27;

        if ($itemCount > 6) {
            $summaryStartRow += $itemCount - 6;
        }

        $contactRow = $summaryStartRow;
        $termRow = $summaryStartRow + 1;
        $subtotalRow = $summaryStartRow;
        $discountRow = $summaryStartRow + 1;
        $vatRow = $summaryStartRow + 2;
        $freightRow = $summaryStartRow + 3;
        $totalRow = $summaryStartRow + 4;

        $worksheet->setCellValue(
            "B{$contactRow}",
            $purchaseOrder->contact_person ?? '-'
        );

        $worksheet->setCellValue(
            "B{$termRow}",
            $purchaseOrder->term_of_payment ?? '-'
        );

        $worksheet->setCellValue(
            "J{$subtotalRow}",
            $purchaseOrder->items->sum('total')
        );

        $worksheet->setCellValue(
            "J{$discountRow}",
            $purchaseOrder->discount
        );

        $worksheet->setCellValue(
            "I{$vatRow}",
            ((float) $purchaseOrder->vat) / 100
        );

        $worksheet->setCellValue(
            "J{$vatRow}",
            "=(J{$subtotalRow}-J{$discountRow})*I{$vatRow}"
        );

        $worksheet->setCellValue(
            "J{$freightRow}",
            $purchaseOrder->freight_cost
        );

        $worksheet->setCellValue(
            "J{$totalRow}",
            "=J{$subtotalRow}-J{$discountRow}+J{$vatRow}+J{$freightRow}"
        );

        $worksheet->getStyle(
            "J{$subtotalRow}:J{$totalRow}"
        )
            ->getNumberFormat()
            ->setFormatCode('#,##0.00');

        $worksheet->getStyle(
            "I{$vatRow}"
        )
            ->getNumberFormat()
            ->setFormatCode('0%');
    }
}