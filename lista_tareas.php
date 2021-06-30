<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar rubros mediante Javascript y Ajax</title>
</head>
<body>
<script src="js/ajax2.js"></script>
    <div id="seccion_busqueda">
        <form id="formulario_busqueda" method="POST">
            <input type="hidden" name="id">
            <label for="cadenaBuscada">Expresión a buscar:</label>
            <input type="text" name="cadenaBuscada" id="cadenaBuscada">
            <span id="resultados"></span>
            <input type="submit" value="Buscar">
        </form>
    </div>

</body>
</html>