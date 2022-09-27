<?php
try {
    $mbd = new PDO('mysql:host=localhost;dbname=callcenter', 'root', '');
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>cv";
    die();
}
