<?php

namespace App\models;

use DateTime;

class DayLight
{
    private DateTime $sunriseTime;
    private DateTime $sunsetTime;

    public function __construct(string $sunriseTime, string $sunsetTime)
    {
        $this->sunriseTime = DateTime::createFromFormat('H:i', $sunriseTime);
        $this->sunsetTime = DateTime::createFromFormat('H:i', $sunsetTime);
    }

    public function getDayLightDuration() : string
    {
        $interval = $this->sunriseTime->diff($this->sunsetTime);
        $hours = $interval->h;
        $minutes = $interval->i;

        $hoursText = $this->getCorrectWord($hours, "година", "години", "годин");

        if ($minutes === 0) {
            return "Рівно $hours $hoursText";
        } else {
            $minutesText = $this->getCorrectWord($minutes, "хвилина", "хвилини", "хвилин");
            return "$hours $hoursText $minutes $minutesText";
        }
    }

    function getCorrectWord($number, $form1, $form2, $form5) {
        if ($number % 10 == 1 && $number % 100 != 11) {
            return $form1;
        } elseif ($number % 10 >= 2 && $number % 10 <= 4 && ($number % 100 < 10 || $number % 100 >= 20)) {
            return $form2;
        } else {
            return $form5;
        }
    }

    public function getSunriseTime(): DateTime
    {
        return $this->sunriseTime;
    }

    public function getSunsetTime(): DateTime
    {
        return $this->sunsetTime;
    }

}