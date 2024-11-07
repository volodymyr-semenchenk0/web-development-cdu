<?php

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

        $hoursText = $this->getCorrectHoursWord($hours);
        if ($minutes === 0) {
            return "Рівно $hours $hoursText";
        } else {
            $minutesText = $this->getCorrectMinutesWord($minutes);
            return "$hours $hoursText $minutes $minutesText";
        }
    }

    private function getCorrectHoursWord($hours): string
    {
        if ($hours % 10 == 1 && $hours % 100 != 11) {
            return "година";
        } elseif ($hours % 10 >= 2 && $hours % 10 <= 4 && ($hours % 100 < 10 || $hours % 100 >= 20)) {
            return "години";
        } else {
            return "годин";
        }
    }

    private function getCorrectMinutesWord($minutes): string
    {
        if ($minutes % 10 == 1 && $minutes % 100 != 11) {
            return "хвилина";
        } elseif ($minutes % 10 >= 2 && $minutes % 10 <= 4 && ($minutes % 100 < 10 || $minutes % 100 >= 20)) {
            return "хвилини";
        } else {
            return "хвилин";
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