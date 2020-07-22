<?php

namespace App;

use CSVRecord;

class CSVExporter 
{

    /**
     * The file name to export to 
     *
     * @var string
     */
    protected string $fileName = "./csv_export.csv";

    /**
     * The records that will go into the csv file
     *
     * @var array
     */
    protected array $records = [];

    /**
     * Set the file location of the csv to be exported
     *
     * @param string filename
     * @return \CSVExporter
     */
    public function setFileName(string $fileName) : CSVExporter
    {
        if (!dirname($fileName)) {
            throw new \Exception("Specified folder $fileName does not exist");
        }

        $this->fileName = $fileName;
        return $this;
    }

    /**
     * Add a record to be written to the csv file
     *
     * @param CSVRecord record
     * @return CSVExporter
     */
    public function addRecord(\App\CSVRecord $record) : CSVExporter
    {
        array_push($this->records, $record);
        return $this;
    }

    /**
     * Write all records to the csv file
     *
     * @return void
     */
    public function export()
    {

        $fileInfo = new \SplFileInfo($this->fileName);
        $file = $fileInfo->openFile('a');

        foreach ($this->records as $record) {
            $file->fputcsv($record->getArray());
        }

    }

}
