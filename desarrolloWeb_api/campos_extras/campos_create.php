<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("INSERT INTO campos_extra (id_usuario, pais, ciudad, fecha_ingreso, fecha_nacimiento, telefono, altura, correo) 
    VALUES (:id_usuario, :pais, :ciudad, :fecha_ingreso, :fecha_nacimiento, :telefono, :altura, :correo)");

    $statement->bindParam(':id_usuario', $id_usuario);
    $statement->bindParam(':pais', $pais);
    $statement->bindParam(':ciudad', $ciudad);
    $statement->bindParam(':fecha_ingreso', $fecha_ingreso);
    $statement->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $statement->bindParam(':telefono', $telefono);
    $statement->bindParam(':altura', $altura);
    $statement->bindParam(':correo', $correo);

    $id_usuario = $_POST['id_usuario'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $altura = $_POST['altura'];
    $correo = $_POST['correo'];

    $statement->execute();
    $_POST['id'] = $mbd->lastInsertId();

    $statement = $mbd->prepare("SELECT * FROM usuarios WHERE id = :id_usuario");
    $statement->bindParam(':id_usuario', $id_usuario);
    $statement->execute();
    $usuario = $statement->fetch(PDO::FETCH_ASSOC);
    $data = $_POST;
    $data['usuario'] = $usuario;

    header('Content-type:application/json;charset=utf-8');
    echo json_encode($data);
} catch (PDOException $e) {
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        'error' => [
            'codigo' => $e->getCode(),
            'mensaje' => $e->getMessage()
        ]
    ]);
}
