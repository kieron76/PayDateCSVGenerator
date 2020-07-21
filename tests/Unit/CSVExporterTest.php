<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\CSVExporter; 
use App\CSVRecord;

class CSVExporterTest extends TestCase
{

    /**
     * set up a exporter for all tests to use
     */ 
    protected $exporter; 

    /**
     * a record that will be added to the exporter
     */ 
    protected $record;


    /**
     * all tests will use this->exporter for testing, set it up here 
     *
     * @return void
     */
    protected function setUp() : void
    {
        if (file_exists('./csv_export.csv')) {
            unlink('./csv_export.csv');
        }
        if (file_exists('./salary_dates.csv')) {
            unlink('./salary_dates.csv');
        }
	$this->record = new \App\CSVRecord();
        $this->record->addField('MonthName', 'January')
            ->addField('BaseSalaryDate', '31/01/2020');
    }

    /**
     * test basic usage of the csv exporter 
     *
     * @return void
     */
    public function testExporter() 
    {
        $exporter = new CSVExporter();
        $exporter->addRecord($this->record)
            ->addRecord($this->record)
            ->export();
        $this->assertTrue(file_exists('./csv_export.csv'));
    }

    /**
     * make sure that the file contains the expected contents 
     *
     * @return void
     */
    public function testExporterContainsExpected() 
    {
        $exporter = new CSVExporter();
        $exporter->addRecord($this->record)
            ->addRecord($this->record)
            ->export();
        $contents = explode(',', file_get_contents('./csv_export.csv'));
        $this->assertTrue(trim($contents[2]) == '31/01/2020');
    }

    /**
     * can we specify our own file 
     *
     * @return void
     */
    public function testExporterCustomFile() 
    {
        $exporter = new CSVExporter();
	$exporter->setFileName("./salary_dates.csv")
            ->addRecord($this->record)
            ->addRecord($this->record)
            ->export();
        $this->assertTrue(file_exists('./salary_dates.csv'));
    }
}
