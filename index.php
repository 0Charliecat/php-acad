<?php
    $timestamp = time();
    $currentDate = gmdate('d. m. Y H:i:s', $timestamp);

    echo "<h1>Ahoj • " . $currentDate . "</h1>";
    echo "<code>".getLogs($timestamp)."</code>";

    function getLogs($time) {
        $Date = gmdate('d. m. Y', $time);
        $Time = gmdate('H:i:s', $time);
        $Meskanie = "";

        if (intval(date("H")) >= 20) {
            die("can't write an arrival after 20:OO");
        }

        if (intval(date("H")) >= 8) {
            $Meskanie = " • mešká";
        }
        file_put_contents("prichody.txt", $Date." ".$Time.$Meskanie."\n", FILE_APPEND);
        $fileconts = file_get_contents("prichody.txt");
        return str_replace("\n", "<br>", $fileconts);
    }
?>
