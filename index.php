<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas PHP Basic</title>
</head>
<body>
    <h1>Importar archivo excel</h1>
    <div id="wrapper">
        <form method="post" action="import_file.php" enctype="multipart/form-data">
            <input type="file" name="file"/>
            <input type="submit" name="submit_file" value="Submit"/>
        </form>
    </div>
</body>
</html>