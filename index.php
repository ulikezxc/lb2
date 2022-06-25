<?php
require_once __DIR__ . "/vendor/autoload.php";

use MongoDB\Client;

$db = new \MongoDB\Client("mongodb://127.0.0.1/");
$db = $db->school->lesson;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LABA2</title>
    <script src="script.js"></script>
</head>
<body>
<br>
<form action="" method="post">
    <select name="group">
        <?php
        $statement = $db->distinct("group");
        foreach ($statement as $data) {
            echo "<option value='$data'>$data</option>";
        }
        ?>
    </select>
    <input type="submit" onclick="save()"><br>
</form>
<?php
if (isset($_POST["group"])) {
    $statement = $db->find(['$and' => [['group'=>$_POST["group"]], ['type'=>'Laboratory']]]);
    echo "<div id='save'>";
    foreach ($statement as $data) {
        echo "День - {$data['week_day']} == Урок - {$data['lesson_number']} == Аудитория - {$data['auditorium']} == Дисциплина - {$data['disciple']} == Группа - {$data['group']}<br>";
    }
    echo "</div>";
}
?>
<br>
<form action="" method="post">
    <select name="teacher">
        <?php
        $statement = $db->distinct("teacher");
        foreach ($statement as $data) {
            echo "<option value='$data'>$data</option>";
        }
        ?>
    </select>
    <select name="disciple" onclick="saveLoad()">
        <?php
        $statement = $db->distinct("disciple");
        foreach ($statement as $data) {
            echo "<option value='$data'>$data</option>";
        }
        ?>
    </select>
    <input type="submit" onclick="save()"><br>
</form>
<?php
if (isset($_POST["teacher"])) {
    $statement = $db->find(['$and' => [['teacher'=>$_POST["teacher"]],['disciple'=>$_POST["disciple"]], ['type'=>'Lecture']]]);
    echo "<div id='save'>";
    foreach ($statement as $data) {
        echo "День - {$data['week_day']} == Урок - {$data['lesson_number']} == Аудитория - {$data['auditorium']} == Дисциплина - {$data['disciple']} == Группа - {$data['group']}<br>";
    }
    echo "</div>";
}
?>
<br>
<form action="" method="post">
    <input type="hidden" name="auditorium">
    <input type="submit" value="Найти аудитории" onclick="save()"><br>
</form>
<?php
if (isset($_POST["auditorium"])) {
    $statement = $db->distinct("auditorium");
    echo "<div id='save'>Аудитории:<br>";
    foreach ($statement as $data) {
        echo "$data;<br>";
    }
    echo "</div>";
}
?>
<br>
<div id="content"></div>
<input type="button" value="Загрузить" onclick="load()">
</body>
</html>
