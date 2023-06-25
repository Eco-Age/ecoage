<?php
require_once("conexao.php");

function inserirRanking($id_usuario, $carreteis, $tempo, $id_patente) {
    $conexao = obterConexao();

    $sql = "SELECT * FROM Ranking WHERE id_usuario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $carreteisSalvos = $row['carreteis'];
        if ($carreteis > $carreteisSalvos) {
            $sql = "UPDATE Ranking SET carreteis = ?, tempo = ?, id_patente = ? WHERE id_usuario = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("isii", $carreteis, $tempo, $id_patente, $id_usuario);
            $stmt->execute();
            $stmt->close();
        }
    } else {
        $sql = "INSERT INTO Ranking (id_usuario, carreteis, tempo, id_patente) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("iisi", $id_usuario, $carreteis, $tempo, $id_patente);
        $stmt->execute();
        $stmt->close();
    }

    $conexao->close();
}
function obterRanking() {
    $conexao = obterConexao();
    $sql = "SELECT r.carreteis, r.tempo, p.patente, u.apelido
            FROM Ranking r
            JOIN Patente p ON r.id_patente = p.id_patente
            JOIN Usuario u ON r.id_usuario = u.id_usuario
            ORDER BY r.carreteis DESC";
    $resultado = $conexao->query($sql);

    $ranking = array();

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $ranking[] = array(
                'apelido' => $row['apelido'],
                'carreteis' => $row['carreteis'],
                'tempo' => $row['tempo'],
                'patente' => $row['patente']
            );
        }
    }

    $conexao->close();
    return json_encode($ranking);
}
$ranking = obterRanking();

echo $ranking;
?>