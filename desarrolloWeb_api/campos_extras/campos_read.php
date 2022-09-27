<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("SELECT * FROM campos_extra WHERE id = :id");
    $statement->bindParam(':id', $id);
    $id = $_GET['id'];      
    $statement->execute();
    $campos = $statement->fetch(PDO::FETCH_ASSOC);

    $statement = $mbd->prepare("SELECT * FROM usuarios WHERE id = :id");
    $statement->bindParam(':id', $id);
    $id = $campos['id_usuario'];      
    $statement->execute();
    $usuario = $statement->fetch(PDO::FETCH_ASSOC);  

    $campos['usuario'] = $usuario;

    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        "campos_extra" => $campos        
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
