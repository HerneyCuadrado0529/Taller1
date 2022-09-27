<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("SELECT * FROM usuarios");
    $statement->execute();
    $usuarios = $statement->fetchAll(PDO::FETCH_ASSOC);

    header('Content-type:application/json;charset=utf-8');
    echo json_encode($usuarios);

} catch (PDOException $e) {
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        'error' => [
            'codigo' => $e->getCode(),
            'mensaje' => $e->getMessage()
        ]
    ]);
}
