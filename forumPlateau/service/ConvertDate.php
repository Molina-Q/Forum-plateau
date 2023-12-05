<?php

namespace Service;

abstract class ConvertDate {

    public static function convertDate($date) {
        $dateTimeCreation = $date; // creationDate
        $currentDate = new \DateTime("now"); // the actual time 
        $timeInterval = date_diff($dateTimeCreation, $currentDate); // the interval between the date of creation and now
        $EndString = " ago";

        // is used to check if the interval is in years, months or days
        $formatProperties = [
                "%y" => "year",
                "%m" => "month",
                "%d" => "day", 
                "%h" => "hour",
                "%i" => "minute",
                "%s" => "sec"
        ];

        foreach($formatProperties as $properties => $stringFormat) {
                $intervalProperties = $timeInterval->format($properties); 

                if($stringFormat == "day" && $intervalProperties >= "7") { // check if the interval is in days and if it is longer than 7 days(a week)
                        $formatedTime = floor($intervalProperties / 7); // is used to check how many week(s) it is by rounding down the division

                        if($formatedTime > "1") { // if it is more than a week (minimum 14 days) there will be an "s" at the end
                                $EndString = "s ago";
                        }

                        $formatedDateString = $formatedTime." week".$EndString;
                        return $formatedDateString; // return the formated string

                } else if($intervalProperties > "0") { // format the date as long as the the timeInterval isn't zero
                        if($intervalProperties > "1") {
                                $EndString = "s ago";
                        }

                        $formatedDateString = $timeInterval->format($properties." ".$stringFormat.$EndString);
                        return $formatedDateString;
                } 
        }
    }
}

