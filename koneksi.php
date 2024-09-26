<?php
$koneksi = new mysqli("localhost", "root", "" , "digitalibrary");

if ($koneksi->connect_error) {
    die("Failed to connect to MySQL: " . $koneksi->connect_error);
}
?>