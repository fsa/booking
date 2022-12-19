<?php
require_once 'config.php';
require_once 'Booking/Description.php';

$pdo = new PDO(...$pdo_params);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt=$pdo->query('SELECT * FROM booking');
while ($row=$stmt->fetchObject()) {
    echo $row->id.PHP_EOL;
    $descr=(new Booking\Description($row->descr))->get();
    var_dump($descr);
}
echo 'Всего строк с другим форматом: '. Booking\Description::$error_format . PHP_EOL;
