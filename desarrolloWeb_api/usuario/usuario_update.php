<?php
include '../conexion.php';

try { 

    $statement = $mbd->prepare("UPDATE usuarios SET nombres = :nombres,  apellidos = :apellidos, edad = :edad WHERE id = :id");
    $statement->bindParam(':id', $id);
    $statement->bindParam(':nombres', $nombres);
    $statement->bindParam(':apellidos', $apellidos);
    $statement->bindParam(':edad', $edad);

    $id = $_POST['id'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];
    $statement->execute();

    $statement = $mbd->prepare("SELECT * FROM usuarios WHERE id = :id");
    $statement->bindParam(':id', $id);
    $id = $_POST['id'];
    $statement->execute();
    $usuarios = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        "mensaje" => "Registro actualizado satisfactoriamente",
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
