<?php
// CONEXION a BASE DE DATOS
// metodo:       mysqli_connect(parametros)
// parametros:   $hostname => donde esta alojada la BD
//               $username => usuario: 'root'
//               $password => pass:    ''       (por defecto)
//               $database => db:      'alumnos2021'
//               $port     =>
//               $socket   =>  
// retorna un OBJETO que llamamos $conexion
$conexion = mysqli_connect("localhost", 'root', "root", 'movies_db');
// en el SERVIDOR https://ar.000webhost.com/members/website/mmdohmen/dashboard
//$conexion = mysqli_connect("localhost", 'id18225605_testo', "Zeta-18079551", 'id18225605_utesto');

if(mysqli_connect_errno()) {
    echo "fallo la conexion - error: " . mysqli_connect_errno();
} else {
    echo "🤙 CONEXION ESTABLECIDA mediante archivo externo";
}
//echo "<br><br>";

// query de insercion
$query = "SELECT * FROM registro";

// OBJETO de tipo 'mysqli_result' q contiene el resultado de la consulta $query realizada
$consulta = mysqli_query($conexion, $query);

echo 'url - nombre - calificacion';
while ($registro = mysqli_fetch_array($consulta)) {
    // 'mysqli_fetch_array(...)' proporciona una forma de iterar sobre los resultados como si fueran filas de un array asociativo que llamamos $registro
    echo $registro['url'] . ' - ' . $registro['nombre'] . ' - ' . $registro['calificacion'];
}

?>