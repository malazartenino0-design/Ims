<?php
$accessDbPath = realpath("inventory.accdb");
$connStr = "odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$accessDbPath;";
$conn = new PDO($connStr);

if (!$conn) {
    die("Connection failed.");
}
?>
<?php
