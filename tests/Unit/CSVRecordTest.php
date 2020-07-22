<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\CSVRecord; 

class CSVRecordTest extends TestCase
{
    /**
     * set up a record for all tests to use
     *
     * @var CSVRecord
     */ 
    protected $record; 


    /**
     * all tests will use this->record for testing, set it up here 
     *
     * @return void
     */
    protected function setUp() : void
    {
	$this->record = new CSVRecord();
        $this->record->addField("MonthName", "January")
            ->addField("BaseSalaryDate", "31/01/2020");
    }
        
    /**
     * test that January is the first element in the array returned
     *
     * @return void
     */
    public function testCSVRecordTest()
    {
        $csvRecord = $this->record->getArray();
        $this->assertTrue($csvRecord[0] == "January");
    }

    /**
     * test that 31/01/2020 is the second element in the array returned
     *
     * @return void
     */
    public function testCSVRecordTest2() 
    {
        $csvRecord = $this->record->getArray();
        $this->assertTrue($csvRecord[1] == "31/01/2020");
    }

    /**
     * test that 31/01/2020 is the first element in the array returned
     *
     * @return void
     */
    public function testReturnOrder() 
    {
        $this->record->setReturnOrder(["BaseSalaryDate"]);
        $csvRecord = $this->record->getArray();
        $this->assertTrue($csvRecord[0] == "31/01/2020");
    }

}
