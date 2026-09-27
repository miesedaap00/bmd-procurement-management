<?php

namespace App\Services;

use App\Models\Quotation;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class QuotationPdfService
{
    private QuotationWordService $wordService;

    public function __construct(
        QuotationWordService $wordService
    ) {
        $this->wordService = $wordService;
    }

    public function generate(Quotation $quotation): string
    {
        $quotation->load('items');

        $docxPath = $this->wordService->generate(
            $quotation
        );

        $docxAbsolutePath = Storage::disk('local')->path(
            $docxPath
        );

        if (!file_exists($docxAbsolutePath)) {
            throw new \RuntimeException(
                'File DOCX quotation tidak ditemukan: ' .
                $docxAbsolutePath
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

        $pdfFileName = $safeFileName . '.pdf';

        $pdfPath = $directory . '/' . $pdfFileName;

        $outputDirectory = Storage::disk('local')->path(
            $directory
        );

        $libreOfficePath = env(
            'LIBREOFFICE_PATH',
            'C:/Program Files/LibreOffice/program/soffice.com'
        );

        if (!file_exists($libreOfficePath)) {
            throw new \RuntimeException(
                'LibreOffice tidak ditemukan pada: ' .
                $libreOfficePath
            );
        }

        $profileDirectory = storage_path(
            'app/lo-profile-' . uniqid()
        );

        File::makeDirectory(
            $profileDirectory,
            0755,
            true
        );

        $profilePath = str_replace(
            '\\',
            '/',
            $profileDirectory
        );

        $process = new Process([
            $libreOfficePath,
            '--headless',
            '--nologo',
            '--nodefault',
            '--norestore',
            '--nofirststartwizard',
            '-env:UserInstallation=file:///' . $profilePath,
            '--convert-to',
            'pdf:writer_pdf_Export',
            '--outdir',
            $outputDirectory,
            $docxAbsolutePath,
        ]);

        $process->setEnv([
            'PYTHONHOME' => env(
                'LIBREOFFICE_PYTHONHOME',
                'C:/Program Files/LibreOffice/program'
            ),
            'PYTHONPATH' => '',
            'TEMP' => sys_get_temp_dir(),
            'TMP' => sys_get_temp_dir(),
        ]);

        $process->setTimeout(120);

        try {
            $process->run();

            $output = trim(
                $process->getOutput()
            );

            $errorOutput = trim(
                $process->getErrorOutput()
            );

            $generatedPdfPath =
                $outputDirectory .
                DIRECTORY_SEPARATOR .
                pathinfo(
                    $docxAbsolutePath,
                    PATHINFO_FILENAME
                ) .
                '.pdf';

            if (!$process->isSuccessful()) {
                throw new \RuntimeException(
                    'LibreOffice gagal menjalankan proses konversi.' .
                    PHP_EOL .
                    'Exit code: ' .
                    ($process->getExitCode() ?? '-') .
                    PHP_EOL .
                    'Output: ' .
                    ($output ?: '-') .
                    PHP_EOL .
                    'Error: ' .
                    ($errorOutput ?: '-')
                );
            }

            if (!file_exists($generatedPdfPath)) {
                throw new \RuntimeException(
                    'PDF tidak ditemukan setelah proses konversi.' .
                    PHP_EOL .
                    'Expected: ' .
                    $generatedPdfPath
                );
            }

            $finalPdfPath = Storage::disk('local')->path(
                $pdfPath
            );

            if (file_exists($finalPdfPath)) {
                unlink($finalPdfPath);
            }

            if ($generatedPdfPath !== $finalPdfPath) {
                rename(
                    $generatedPdfPath,
                    $finalPdfPath
                );
            }

            return $pdfPath;
        } finally {
            if (File::exists($profileDirectory)) {
                File::deleteDirectory(
                    $profileDirectory
                );
            }
        }
    }
}