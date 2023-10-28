<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

    if (!file_exists("arrivals.json")) {
        file_put_contents("arrivals.json", "[]");
    }

    $studs = [];
    $studs = json_decode(file_get_contents('arrivals.json'));

    date_default_timezone_set("Europe/Bratislava");
    $timestamp = time();
    $currentDate = gmdate('d. m. Y H:i:s', $timestamp);

    echo "<h1>" . $currentDate . "</h1>";
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    Meno: <input type="text" name="name">
    <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_GET['name'])) {
    // collect value of input field
    $name = $_POST['name'];
    if (empty($name)) {
        echo "Bez Mena?";
    } else {
        echo "Ahoj, ".$name;
    }
    writeLogs($timestamp, $name);
}
?>

<?php

echo "<code>".getLogs()."</code>";

function writeLogs($time, $name) {

    global $studs;
    $Meskanie = "";

    if (intval(date("H")) >= 8) {
        $Meskanie = "isLate";
    }

    if (intval(date("H")) >= 20) {
        die("can't write an arrival after 20:OO");
    }

    array_push($studs, ["time" => $time, "note" => $Meskanie, "name" => $name]);

    file_put_contents("arrivals.json", json_encode($studs));
}

function getLogs() {
        $fileconts = file_get_contents("arrivals.json");
        return $fileconts;
    }
?>

</body>
</html>