<?php
Class Conexion {

    public static function conectar() {
        
        $user="root";
        $pass="";
        $server="localhost";
        $db="di_calidad";
        
        $con = mysql_connect('localhost', 'root', '') or die("Error de Conexi&oacute;n al Servidor");
        mysql_query("SET NAMES 'utf8'");
        mysql_select_db("di_calidad") or die("La base de datos no existe");
        return $con;
    }

}

Class Sesion {
            
    public function ingresar($usuario, $password) {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password' ";
        $result = mysql_query($sql, Conexion::conectar());
        
        $num_filas = mysql_num_rows($result);
        
        if($num_filas == 1){
            
        if ($fila = mysql_fetch_array($result)) {
            $_SESSION['nombre_s'] = $fila[1];
            $_SESSION['privilegios_s'] = $fila[4];
            
            if ($_SESSION['privilegios_s'] == 'Administrador') {
                    echo '<script type="text/javascript">
                    window.location.href="usuarios/admin/menu.php";      
                    </script>';
                    }
                    if ($_SESSION['privilegios_s'] == 'Analista') {
                        echo '<script type="text/javascript">
                        window.location.href="usuarios/analista/menu.php";      
                        </script>';
                        }
                        if ($_SESSION['privilegios_s'] == 'User') {
                            echo '<script type="text/javascript">
                            window.location.href="usuarios/users/menu.php";      
                            </script>';
                            }
        }
        }else{
          echo '<script type="text/javascript">
                  alert("Usuario o Contraseña Incorrecta");
                 </script>';  
        }
       
   
    }

}
?>
