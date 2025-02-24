<?php
include 'config.php';

$id = $_GET['id'];
$query = "DELETE FROM tasks WHERE id = $id";

if (mysqli_query($koneksi, $query)) {
    header("Location: index.php");
}
?>
