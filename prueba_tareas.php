<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba tareas</title>
</head>
<body>

    <?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "agenda777";

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_errno) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT `Proyecto` FROM `csltareas` WHERE 1 GROUP BY `Proyecto`";
    $resultPy = $conn->query($sql);

    if($resultPy) {
        print "<table><tr><th>Proyecto</th><th>Módulo</th><th>Actividad</th>
                <th>Tarea</th><th>U.M.</th><th>Meta</></tr>";
        
        while($rowPy = $resultPy->fetch_assoc()) {
            print "<tr><td>".$rowPy["Proyecto"]."</td><td></td><td></td>
                <td></td><td></td><td></td></tr>";
            $sql = "SELECT `Modulo` FROM `csltareas` WHERE `Proyecto`='".$rowPy["Proyecto"]."' GROUP BY `Modulo`";
            //printf("<p>SQL: %s</p>",$sql);
            $resultMd = $conn->query($sql);

            if($resultMd) {
                while($rowMd = $resultMd->fetch_assoc()) {
                    print "<tr><td></td><td>".$rowMd["Modulo"]."</td><td></td>
                        <td></td><td></td><td></td></tr>";
                    $sql = "SELECT `Actividad` FROM `csltareas` WHERE `Proyecto`='".$rowPy["Proyecto"]."' 
                            AND `Modulo`='".$rowMd["Modulo"]."' GROUP BY `Actividad`";
                    $resultAc = $conn->query($sql);

                    if($resultAc) {
                        while($rowAc = $resultAc->fetch_assoc()) {
                            print "<tr><td></td><td></td><td>".$rowAc["Actividad"]."</td>
                                <td></td><td></td><td></td></tr>";
                            $sql = "SELECT `Tarea`, `UnidadDeMedida`, `MetaFisica` 
                                    FROM `csltareas` 
                                    WHERE `Proyecto`='".$rowPy["Proyecto"]."' 
                                        AND `Modulo`='".$rowMd["Modulo"]."' 
                                        AND `Actividad`='".$rowAc["Actividad"]."'";
                            $result = $conn->query($sql);

                            if($result) {
                                while($row = $result->fetch_assoc()) {
                                    print "<tr><td></td><td></td><td></td>
                                        <td>".$row["Tarea"]."</td><td>".$row["UnidadDeMedida"]."</td>
                                        <td>".$row["MetaFisica"]."</td></tr>";
                                }
                            } else {
                                print "<p>No hay resultados Tareas</p>";
                            }

                            $result->close();
                        }
                    } else {
                        print "<p>No hay resultados Actividad</p>";
                    }

                    $resultAc->close();
                }
            } else {
                print "<p>No hay resultados Módulo</p>";
            }

            $resultMd->close();
        }
        
        print "</table>";
    } else {
        print "<p>No hay resultados</p>";
    }

    $resultPy->close();
    $conn->close();

    ?>

</body>
</html>