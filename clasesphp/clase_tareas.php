<?php

class Tareas
{
    private $conn;
    //private $cadena;

    function __construct()
    {
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'agenda777';

        $this->conn = new mysqli($hostname, $username, $password, $database);

        if ($this->conn->connect_errno)
        {
            die ("Error de conexión:" . $this->conn->connect_error);
            return false;
        }

    }

    function listaBuscada($cadena)
    {
        //$cadena = (isset($_POST['cadenaBuscada']) ? $_POST['cadenaBuscada'] : '');
        $info = array();
        $sql = "
                SELECT Tarea 
                FROM tbltareas 
                WHERE Tarea LIKE '%".$cadena."%' 
                ORDER BY Tarea 
                LIMIT 5
                ";
        $result = $this->conn->query($sql);
        if ($result) 
        {
            if ($result->num_rows > 0) 
            {
                $cadenaBold = '<b>'.$cadena.'</b>';
                while ($row = $result->fetch_assoc())
                {
                    $info[] = array (
                        "Tarea"  =>  str_ireplace($cadena, $cadenaBold, $row["Tarea"])
                    );
                }
            }
        }
        $result->close();
        return json_encode($info);
    }


    function __destruct()
    {
        return true;
    }
}