<?php
include '../conexion.php';

try {

    $statement = $mbd->prepare("SELECT * FROM campos_extra");
    $statement->execute();
    $campos = $statement->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < count($campos); $i++) {
        $statement = $mbd->prepare("SELECT * FROM usuarios where id = :id");
        $statement->bindParam(':id', $id);
        $id = $campos[$i]['id_usuario'];
        $statement->execute();
        $usuario = $statement->fetch(PDO::FETCH_ASSOC);
        $campos[$i]['usuario'] = $usuario;
    }

    header('Content-type:application/json;charset=utf-8');
    echo json_encode($campos);
} catch (PDOException $e) {
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        'error' => [
            'codigo' => $e->getCode(),
            'mensaje' => $e->getMessage()
        ]
    ]);
}
