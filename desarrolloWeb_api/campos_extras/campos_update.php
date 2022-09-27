<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("UPDATE campos_extra SET id_usuario = :id_usuario, pais = :pais, ciudad = :ciudad, fecha_ingreso = :fecha_ingreso, fecha_nacimiento = :fecha_nacimiento, telefono = :telefono, altura = :altura, correo = :correo WHERE id = :id");

    $statement->bindParam(':id', $id);
    $statement->bindParam(':id_usuario', $id_usuario);
    $statement->bindParam(':pais', $pais);
    $statement->bindParam(':ciudad', $ciudad);
    $statement->bindParam(':fecha_ingreso', $fecha_ingreso);
    $statement->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $statement->bindParam(':telefono', $telefono);
    $statement->bindParam(':altura', $altura);
    $statement->bindParam(':correo', $correo);

    $id = $_POST['id'];
    $id_usuario = $_POST['id_usuario'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $altura = $_POST['altura'];
    $correo = $_POST['correo'];

    $statement->execute();

    $statement = $mbd->prepare("SELECT * FROM campos_extra WHERE id = :id");
    $statement->bindParam(':id', $id);
    $id = $_POST['id'];
    $statement->execute();
    $campos = $statement->fetch(PDO::FETCH_ASSOC);
  
    $statement = $mbd->prepare("SELECT * FROM usuarios WHERE id = :id");
    $statement->bindParam(':id', $id);
    $id = $_POST['id_usuario'];
    $statement->execute();
    $usuario = $statement->fetch(PDO::FETCH_ASSOC);  

    $campos['usuario'] = $usuario;

    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        "mensaje" => "Registro actualizado satisfactoriamente",
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
