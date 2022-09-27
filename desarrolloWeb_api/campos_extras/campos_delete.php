<?php
include '../conexion.php';

try {


    $statement = $mbd->prepare("SELECT * FROM campos_extra WHERE id = :id");
    $statement->bindParam(':id', $id);    
    $id = $_POST['id'];
    $statement->execute();
    $campos = $statement->fetch(PDO::FETCH_ASSOC);
  
    $statement = $mbd->prepare("SELECT * FROM usuarios WHERE id = :id");
    $statement->bindParam(':id', $id);    
    $id = $campos['id_usuario'];
    $statement->execute();
    $usuario = $statement->fetch(PDO::FETCH_ASSOC);  

    $campos['usuario'] = $usuario;

    $statement = $mbd->prepare("DELETE FROM campos_extra WHERE id = :id");
    $statement->bindParam(':id', $id);    
    $id = $_POST['id'];
    $statement->execute();

    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        "mensaje" => "Registro eliminado satisfactoriamnte",
        "data" => $campos  
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
