<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("INSERT INTO usuarios (nombres, apellidos, edad) VALUES (:nombres, :apellidos, :edad)");

    $statement->bindParam(':nombres', $nombres);
    $statement->bindParam(':apellidos', $apellidos);
    $statement->bindParam(':edad', $edad);

    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];  

    $statement->execute();
    $_POST['id'] = $mbd->lastInsertId();
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($_POST);
} catch (PDOException $e) {
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        'error' => [
            'codigo' => $e->getCode(),
            'mensaje' => $e->getMessage()
        ]
    ]);
}
