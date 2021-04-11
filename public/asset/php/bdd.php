<?php
$db = new PDO('mysql:host=db;dbname=bennezai', 'bennezai', 'bennezai');

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.

