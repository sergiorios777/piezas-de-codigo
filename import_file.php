<?php
// Importar archivos de excel
/*  // Database Structure 
    CREATE TABLE 'employee' (
    'name' text NOT NULL,
    'age' text NOT NULL,
    'country' text NOT NULL,
    ) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1
*/

    if(isset($_POST["submit_file"]))
    {
        $file = $_FILES["file"]["tmp_name"];
        $file_open = fopen($file,"r");
        while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
        {
            $name = $csv[0];
            $age = $csv[1];
            $country = $csv[2];
            mysqli_query("","INSERT INTO employee VALUES ('$name','$age','country')");
        }
    }
