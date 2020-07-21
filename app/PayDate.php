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

    public __construct(\DateTime $date = null) 
    {
        if ($date) {
            $this->date = $date
        } else {
            $this->date = new \DateTime();
        }
    }


    public function getBasePayDate($addMonths = 0) : self
    {

        $this->date->add(new DateInterval('P'.$addMonths.'M');
        $lastDayOfMonthName = new DateTime($this->date->format('t'))->format('l');
        if (in_array($this->weekDays, $lastDayOfMonth)) {
            return new DateTime($this->format('t'));
        }

        if ($lastDayOfMonthName = 'Saturday') {
            return $this->sub(new DateInterval('P1D'));
        }

        if ($lastDayOfMonthName = 'Sunday') {
            return $this->sub(new DateInterval('P2D'));
        }
    }
}
