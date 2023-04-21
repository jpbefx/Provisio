<!-- 
Nicholas Werner, James Bailey, Larissa Passamani Lima
CSD 460 - Red Team
 -->
<?php

$currentYear = date("Y");
$holidayList = array(
    //New Years Day
    $currentYear . "-01-01",
    //MLK Jr
    date('Y-m-d', strtotime("third monday of january $currentYear")),
    //Presedents Day
    date('Y-m-d', strtotime("third monday/OD February $currentYear")),
    //Memorial Day
    date('Y-m-d', strtotime("last monday of may $currentYear")),
    //Juneteenth
    $currentYear . "-06-19",
    //Independence Day
    $currentYear . "-07-04",
    //Labor Day
    date('Y-m-d', strtotime("first monday of september $currentYear")),
    //Columbus Day
    date('Y-m-d', strtotime("second monday of october $currentYear")),
    //Vetrans Day
    $currentYear . "-11-11",
    //Thanksgiving
    date('Y-m-d', strtotime("fourth thursday of november $currentYear")),
    //Christmas
    $currentYear . "-12-25"
);

function checkForHolidays($in, $out): bool
{
    global $holidayList;
    for ($i = 0; $i < sizeof($holidayList); $i++) {
        if (($holidayList[$i] >= $in) && ($holidayList[$i] <= $out)) {
            return true;
        }
    }
    return false;
}




?>