<?php

namespace App;

use CSVRecord;

class CSVExporter 
{
    protected string $fileName = "./csv_export.csv";

    protected array $records = [];

    public function setFileName(string $fileName) : CSVExporter
    {
        if (!dirname($fileName)) {
            throw new \Exception("Specified folder $fileName does not exist");
        }

        $this->fileName = $fileName;
        return $this;
    }

    public function addRecord(\App\CSVRecord $record) : CSVExporter
    {
        array_push($this->records, $record);
        return $this;
    }

    public function export()
    {

        $fileInfo = new \SplFileInfo($this->fileName);
        $file = $fileInfo->openFile('a');

        foreach ($this->records as $record) {
            $file->fputcsv($record->getArray());
        }

        $file = null;
    }

}
