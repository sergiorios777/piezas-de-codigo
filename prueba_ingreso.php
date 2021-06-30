<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba ingreso</title>

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
    $sql = "SELECT `IdUnidadDeMedida`, `UnidadDeMedida` FROM `tblunidadesdemedida` WHERE 1";
    $result = $conn->query("$sql");
?>
<section id="formulario_ingreso">
    <form id="formulario" method="post">
        <label for="Proyecto">Proyecto:</label>
        <input type="text" id="Proyecto" name="Proyecto" maxlength="150" required>
        <label for="UnidadDeMedida">Unidad de medida:</label>
        <input type="text" id="UnidadDeMedida" name="UnidadDeMedida" list="listaUnidades">
        <datalist id="listaUnidades">
        <?php 
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    print "<option>".$row["UnidadDeMedida"]."</option>";
                }
            } else {
                print "<option>Sin resultados</option>";
            }
            $result->close();
        ?>
        </datalist>
        <label for="MetaFisica">Meta:</label>
        <input type="number" id="MetaFisica" name="MetaFisica" required>
        <input id="enviarAjax" type="submit" value="Enviar">
    </form>
<?php
    $conn->close();
?>
</section>
<section id="resultados">
    <div id="cuadro"><p>La información estará acá...</p></div>
</section>
<script>
    (function() {
        var httpRequest;
        
        document.getElementById("formulario").onsubmit = function () {
            
            var sProyecto = document.getElementById("Proyecto").value;
            var sUnidadDeMedida = document.getElementById("UnidadDeMedida").value;
            var dMetaFisica = document.getElementById("MetaFisica").value;
            var uData = "Proyecto="+encodeURIComponent(sProyecto)+"&UnidadDeMedida="+encodeURIComponent(sUnidadDeMedida)+
                        "&MetaFisica="+encodeURIComponent(dMetaFisica);
            makeRequest('insertarPy.php', uData);
            
            document.getElementById("Proyecto").value = '';
            document.getElementById("UnidadDeMedida").value = '';
            document.getElementById("MetaFisica").value = '';
            
            return false;
        }

        function makeRequest(url, uData) {
            httpRequest = new XMLHttpRequest();

            if (!httpRequest) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }
            httpRequest.onreadystatechange = alertContents;
            httpRequest.open('POST', url, true);
            httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            httpRequest.send(uData);
        }

        function alertContents() {
            //alert("readyState: " + httpRequest.readyState + " | status: " + httpRequest.status);
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    document.getElementById("cuadro").innerHTML = httpRequest.responseText;
                    agregaEventoAFilas();
                    //alert("httpRequest Pasó");
                } else {
                    //alert("httpRequest <> 200");
                    document.getElementById("cuadro").innerHTML = "<p>Resultado vacío.</p>";
                }
            }
        }

        function agregaEventoAFilas()
        {
            console.log("f_agregaEventoAFilas");
            var filas = document.getElementById("tabla_resultado").rows;
            for (i = 1; i < filas.length; i++)
            {
                filas[i].onclick = function () 
                {
                    return function ()
                    {
                        console.log("En la función 'onclick.function'");
                        var id = this.cells[0].innerHTML;
                        alert("id: " + id);
                    }
                }
                (filas[i]);
            }
        }

    })();
</script>

</body>
</html>