<?php
$horarios = [];
while ($tupla_horario_tabla = mysqli_fetch_assoc($result_horario_profesor)) {
    $horarios[] = $tupla_horario_tabla;
}

echo "<h3>Horario del Profesor: " . $nombre_profesor . "</h3>";
echo "<table>";
echo "<tr>";
for ($dias = 0; $dias < count(DIAS_SEMANA); $dias++) {
    echo "<th>" . DIAS_SEMANA[$dias] . "</th>";
}
echo "</tr>";

for ($horario = 1; $horario < count(HORAIO_SEMANA); $horario++) {
    echo "<tr>";
    echo "<th>" . HORAIO_SEMANA[$horario] . "</th>";
    if ($horario == 4)
        echo "<td colspan='5'>RRECREO</td>";
    else {
        for ($clases = 1; $clases < 6; $clases++) {
            echo "<td>";
            $contenido_celda = [];
            foreach ($horarios as $tupla_horario_tabla) {
                if ($tupla_horario_tabla["dia"] == $clases && $tupla_horario_tabla["hora"] == $horario) {
                    $contenido_celda[] = $tupla_horario_tabla["nombre"];
                }
            }
            echo implode("/", $contenido_celda);
            echo "<form action='index.php' method='post'><button type='submit' class='enlace' value='" . $clases . "|" . $horario .  "' name='btnEditar'>Editar</button></form></td>";
        }
    }

    echo "</tr>";
}
echo "</table>";
?>