<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("SELECT * FROM usuarios WHERE id = :id");
    $statement->bindParam(':id', $id);
    $id = $_POST['id'];
    $statement->execute();
    $usuarios = $statement->fetchAll(PDO::FETCH_ASSOC);

    $statement = $mbd->prepare("DELETE FROM usuarios WHERE id = :id");
    $statement->bindParam(':id', $id);
    $id = $_POST['id'];

    $statement->execute();
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        "mensaje" => "Registro eliminado satisfactoriamnte",
        "data" => $usuarios
    ]);
} catch (PDOException $e) {
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        'error' => [
            'codigo' => $e->getCode(),
            'mensaje' => $e->getMessage()
        ]
    ]);
}
