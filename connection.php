<?php
$connection = new mysqli("localhost", "root", "root", "blog");


if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
