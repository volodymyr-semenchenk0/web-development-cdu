<?php

namespace App\Helpers;

use DateTime;
use Exception;

class DateHelper
{
    /**
     * @throws Exception
     */
    public static function convertUAFormatToDateTime($dateString): DateTime
    {
        $daysMap = [
            'пн' => 'Mon', 'вт' => 'Tue', 'ср' => 'Wed', 'чт' => 'Thu',
            'пт' => 'Fri', 'сб' => 'Sat', 'нд' => 'Sun'
        ];

        $monthsMap = [
            'січ' => 'Jan', 'лют' => 'Feb', 'бер' => 'Mar', 'квіт' => 'Apr',
            'трав' => 'May', 'черв' => 'Jun', 'лип' => 'Jul', 'серп' => 'Aug',
            'вер' => 'Sep', 'жовт' => 'Oct', 'лист' => 'Nov', 'груд' => 'Dec'
        ];

        $dateString = strtr($dateString, $daysMap);
        $dateString = strtr($dateString, $monthsMap);
        $dateString .= ' ' . date('Y');

        $date = DateTime::createFromFormat('D, j M Y', $dateString);

        return $date === false ? throw new Exception("Invalid date format") : $date;

    }
}