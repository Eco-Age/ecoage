<?php
require_once ("../database/conexao.php");


function buscarPatente() {
    $conexao = obterConexao();
    $sql = "SELECT p.patente
            FROM Ranking r
            JOIN Patente p ON r.id_patente = p.id_patente
            WHERE r.id_usuario = ?
            ORDER BY r.carreteis DESC
            LIMIT 1";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $_SESSION['id_usuario']);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $patente = $row['patente'];
        $stmt->close();
        $conexao->close();
        return $patente;
    }

    $stmt->close();
    $conexao->close();
    return null;
}


?>