<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\PayDate;

class PayDateTest extends TestCase
{



    /**
     * hold an instance of PayDate for the tests to use
     *
     * @var PayDate sd 
     */
    protected $sd;

    /**
     * all tests will use this->record for testing, set it up here 
     *
     * @return void
     */
    protected function setUp() : void
    {
	// try with random date rather than now
	$this->sd = new PayDate(new \DateTime('20-02-20'));
    }

    /**
     * test to make sure that the last week day is 28th Feb 
     *
     * @return void
     */
    public function testBasePayDate()
    {
	$this->assertTrue($this->sd->getBasePayDate()->format('d-m-y') == '28-02-20');
    } 

    /**
     * test to make sure that the last week day 8 months in advance
     * is 30th October 
     *
     * @return void
     */
    public function testBasePayDateFuture()
    {
	$this->assertTrue($this->sd->getBasePayDate(8)->format('d-m-y') == '30-10-20');
    } 

    /**
     * test to make sure that the bonus date in february is 10th 
     *
     * @return void
     */
    public function testBonusPayDate()
    {
	$this->assertTrue($this->sd->getBonusPayDate()->format('d-m-y') == '10-02-20');
    } 

    /**
     * test to make sure that the bonus date in May is 12th (10th is a Sunday)
     *
     * @return void
     */
    public function testBonusPayDateFuture()
    {
	$this->assertTrue($this->sd->getBonusPayDate(3)->format('d-m-y') == '12-05-20');
    } 
}
