<?php

namespace App;

class PayDate 
{

    protected $date;

    protected $weekDays = [
        'Monday', 
        'Tuesday', 
        'Wednesday', 
        'Thursday', 
        'Friday',
    ];

    public function __construct(\DateTime $date = null) 
    {
        if ($date) {
            $this->date = $date;
        } else {
            $this->date = new \DateTime();
        }
    }


    public function getBasePayDate($addMonths = 0) : \DateTime
    {

        $this->date->add(new \DateInterval('P'.$addMonths.'M'));
	$lastDayOfMonth = new \DateTime($this->date->format('t').'-'.$this->date->format('m-Y'));
	$lastDayOfMonthName = $lastDayOfMonth->format('l');
        if (in_array($lastDayOfMonthName, $this->weekDays)) {
            return $lastDayOfMonth;
        }

        if ($lastDayOfMonthName = 'Saturday') {
            return $lastDayOfMonth->sub(new \DateInterval('P1D'));
        }

        if ($lastDayOfMonthName = 'Sunday') {
            return $lastDayOfMonth->sub(new \DateInterval('P2D'));
        }
    }
}
