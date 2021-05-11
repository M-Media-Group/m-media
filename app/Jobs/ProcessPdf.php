<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\File;
use Spatie\PdfToText\Pdf as SpatiePdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File as StorageFile;

class ProcessPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $file;
    protected $saveData;
    protected $reSaveFile;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $reSaveFile = true, $saveData = false)
    {
        $this->file = $file;
        $this->saveData = $saveData;
        $this->reSaveFile = $reSaveFile;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      function getEmailsByString($string) {
        $pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]+)(?:\.[a-z]{2})?/i';
        preg_match_all($pattern, $string, $matches);
        return array_unique($matches[0]);
      }
      function getUrlsByString($string) {
        $pattern = '/((https?):\/\/)?[-a-zA-Z0-9:%._\+~#]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9():%_\+.~#?&=]*)/i';
        preg_match_all($pattern, $string, $matches);
        return array_unique($matches[0]);
      }
      function getPhonesNumbersByString($string) {
        $pattern1 = '/^[0-9\-\(\)\/\+\s]*$/i';
        preg_match_all($pattern1, $string, $search1);
        return array_unique($search1[0]);
      };
      function getTextFromPdf($path) {
        return (new SpatiePdf())->setPdf($path)->text();
      };
      // Get the file url
      $fileUrl = $this->file->url;
      // Copy the file to the temp folder
      $processedTempFile = sys_get_temp_dir().'\processedTempFile.pdf';
      $tempFile = sys_get_temp_dir().'\tempFile.pdf';
      copy($fileUrl, $tempFile);
      // Try extract text from the pdf
      $pdfString = getTextFromPdf($tempFile);
      // Testing if we have found text
      if ($pdfString === '') {
        // Run OCR and save the processed file into temp folder
        exec('ocrmypdf --optimize 0 '.$tempFile.' '.$processedTempFile, $output, $result_code);
        // Try extract text from the pdf
        $pdfString = getTextFromPdf($processedTempFile);
      };
      // Find data from the extrated text
      $data = [
        'emails' => getEmailsByString($pdfString),
        'urls' => getUrlsByString($pdfString),
        'phones' => getPhonesNumbersByString($pdfString),
        ];
      // Save data into database
      if ($this->saveData) {
        foreach ($data['emails'] as $email) {
            SaveEmail::dispatch(['email' => $email]);
        }
        foreach ($data['phones'] as $phone) {
            SavePhone::dispatch($phone);
        }
      }
      // Save the processed pdf into database and remove the temp file
      if ($this->reSaveFile) {
        if ($pdfString === '') {
          $filePath = Storage::putFile('files/internshippdf', new StorageFile($processedTempFile));
          unlink($tempFile);
          unlink($processedTempFile);
        } else {
          $filePath = Storage::putFile('files/internshipPdf', new StorageFile($tempFile));
          unlink($tempFile);
        }
      }
      if (empty($data['emails'])) {
        $data['emails'][0] = '<no email found in ocr>';
      }
      if (empty($data['urls'])) {
        $data['urls'][0] = '<no url found in ocr>';
      }
      if (empty($data['phones'])) {
        $data['phones'][0] = '<no phone found in ocr>';
      }
      return $data;
    }
}
