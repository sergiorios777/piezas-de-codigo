<?php 
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "agenda777";

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_errno) {
        die("Error de conexión: " . $conn->connect_error);
    }
    
    $Proyecto       = $_POST['Proyecto'];
    $UnidadDeMedida = $_POST['UnidadDeMedida'];
    $MetaFisica     = $_POST['MetaFisica'];
    
    // Determinar el IdUnidadDeMedida
    
    $sql    = "SELECT `IdUnidadDeMedida` FROM `tblunidadesdemedida` WHERE `UnidadDeMedida`='".$UnidadDeMedida."'";
    $result = $conn->query("$sql");

    if ($result) {

        $row = $result->fetch_array(MYSQLI_ASSOC);
        $IdUnidadDeMedida = $row["IdUnidadDeMedida"];

    } else {
        echo "";
        return;
    }
    $result->free();
    
    // Inserta el nuevo registro

    //$sql = "INSERT INTO tblproyectos (Proyecto, IdUnidadDeMedida, MetaFisica) VALUES ('".$Proyecto."', '".$IdUnidadDeMedida."', '".$MetaFisica."')";
    $sql = "UPDATE tblproyectos SET IdUnidadDeMedida='1' WHERE IdProyecto='1'";
    if ($conn->query($sql) === TRUE) {
        
        // genera el nuevo cuadro de resultados
        $sql    = "SELECT IdProyecto, Proyecto, UnidadDeMedida, MetaFisica FROM tblproyectos LEFT JOIN tblunidadesdemedida USING(IdUnidadDeMedida) WHERE 1";
        $result = $conn->query($sql);

        if ($result) {
            $cdr = "<table id='tabla_resultado'>
                    <tr><th>Id:</th><th>Proyecto:</th><th>Unidad de Medida:</th><th>MetaFisica:</th></tr>";
            while ($row = $result->fetch_assoc()) {
                $cdr = $cdr . "<tr><td>".$row["IdProyecto"]."</td><td>".$row["Proyecto"]."</td><td>".$row["UnidadDeMedida"]."</td><td>".$row["MetaFisica"]."</td></tr>";
            }
            $cdr = $cdr . "</table>";
            echo $cdr;
        } else {
            echo "<p>No hay información de proyectos</p>";
        }
        $result->free();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();