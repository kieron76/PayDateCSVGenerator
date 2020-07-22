<?php

namespace App;

class PayDate 
{

    /**
     * a date in the month to base the calculated dates off
     */
    protected $date;

    /**
     * an array of the week days
     */
    protected $weekDays = [
        'Monday', 
        'Tuesday', 
        'Wednesday', 
        'Thursday', 
        'Friday',
    ];

    /**
     * Create new instance with today's date being the default to work off
     *
     * @param \DateTime $date
     * @return void
     */
    public function __construct(\DateTime $date = null) 
    {
        if ($date) {
            $this->date = $date;
        } else {
            $this->date = new \DateTime();
        }
    }

    /**
     * Get the base pay date for the month of $this->date 
     * Or get the base pay date for the month + $addMonths of $this->date
     *
     * @param int $addMonths
     * @return \DateTime
     */
    public function getBasePayDate(int $addMonths = 0) : \DateTime
    {
        $tmpDate = new \DateTime($this->date->format('c'));

        $tmpDate->add(new \DateInterval('P'.$addMonths.'M'));

	$lastDayOfMonth = new \DateTime($tmpDate->format('t').'-'.$tmpDate->format('m-Y'));
	$lastDayOfMonthName = $lastDayOfMonth->format('l');
        // is the last day of the month a weekday?
        if (in_array($lastDayOfMonthName, $this->weekDays)) {
            return $lastDayOfMonth;
        }

        // if the last day of the month is a Saturday then 
        // pay day will be one day prior
        if ($lastDayOfMonthName == 'Saturday') {
            return $lastDayOfMonth->sub(new \DateInterval('P1D'));
        }

        // must be a sunday so payday will be 2 days prior
        return $lastDayOfMonth->sub(new \DateInterval('P2D'));
    }

    /**
     * Get the bonus pay date for the month of $this->date 
     * Or get the bonus pay date for the month + $addMonths of $this->date
     *
     * @param int $addMonths
     * @return \DateTime
     */
    public function getBonusPayDate(int $addMonths = 0) : \DateTime
    {
        $tmpDate = new \DateTime($this->date->format('c'));
        $tmpDate->add(new \DateInterval('P'.$addMonths.'M'));

        // get the 10th day of the month 
        $tmpDate = new \DateTime('10-'.$tmpDate->format('m-Y'));
        $bonusPayDayName = $tmpDate->format('l');

        // if its a weekday then great
        if (in_array($bonusPayDayName, $this->weekDays)) {
            return $tmpDate;
        }

        // if the 10th is a Saturday, bonus is paid on the Tuesday
        // which will be in 3 days time
        if ($bonusPayDayName == 'Saturday') {
            return $tmpDate->add(new \DateInterval('P3D'));
        }


        // must be a sunday, the following Tuesday will be in 2 days time
        return $tmpDate->add(new \DateInterval('P2D'));
    }

    /**
     * Get the date name of the month
     *
     * @param int $addMonths
     * @return string
     */
    public function getMonthName(int $addMonths = 0) : string
    {
        $tmpDate = new \DateTime($this->date->format('c'));
        $tmpDate->add(new \DateInterval('P'.$addMonths.'M'));
        return $tmpDate->format('F');
    }



}
