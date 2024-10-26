<?php
$host = 'sql12.freesqldatabase.com';
$dbname = 'sql12740730';
$username = 'sql12740730';
$password = 'GcLhhY2bDS';
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
