<?php
  $registros=array();
  $lasInsertID = 0;
  $conexion= new mysqli("127.0.0.1","root","N1ct@3l","Registros");
  if ($conexion->errno){
    die("DB no can: " . $conexion->error);
  }

  if(isset($_POST["btnenviar"])){
    $registro=array();
    $registro["Descripcion"]=$_POST["txtdescripcion"];
    $registro["Estado"]=$_POST["optestado"];


    $sqlinsert ="INSERT INTO `categorias` ( `ctgdsc`, `ctgest`)";
    $sqlinsert.="VALUES ('". $registro["Descripcion"] ."' , '". $registro["Estado"] ."');";
    $result = $conexion->query($sqlinsert);
  }

  if(isset($_POST[btnmodificar])){
    if($_POST[txtdescripcion]!=""){
      $modifi="update categorias set ctgdsc= '". $_POST["txtdescripcion"] ."' where ctgid='".$_POST["txtidmodificar"]."'";
      $result2 = $conexion->query($modifi);
    }
    if($_POST[optestado]!=""){
      $modifi="update categorias set ctgest= '". $_POST["optestado"] ."' where ctgid='".$_POST["txtidmodificar"]."'";
      $result2 = $conexion->query($modifi);
    }


  }
  $lasInsertID = $conexion->insert_id;
  $sqlQuery = "Select * from categorias;";

  $resulCursor = $conexion->query($sqlQuery);

  while($registro = $resulCursor->fetch_assoc()){
    $registros[] = $registro;
  }


?>
<html>
  <head>
    <title>Tarea3</title>
  </head>
  <body>
    <h1>Tarea 2</h1>
    <h2>Tabla de Categorias</h2>
    <form action="tarea2.php" method="POST">
      <label for="txtdescripcion">Descripcion</label>
      <input type="text" name="txtdescripcion"/>
      <br>
      <label for="optestado">Estado</label>
      <select name="optestado" id="estado">
        <option value="act">Activo</option>
        <option value="des">desactivo</option>
      </select>
      <br>
      <input type="submit" name="btnenviar" id="btnenviar" value="Enviar registro"/>
      <br><br>
      <input type="submit" name="btnmodificar" id="btnmodificar" value="modificar"/>
      <label for="txtidmodificar">ID a modificar</label>
      <input type="text" name="txtidmodificar"/>
      <br>
    </form>

    <div>
      <h2>Registros</h2>
      <table border="1">
        <tr>
          <th>Codigo</th>
          <th>Descripcion</th>
          <th>Estado</th>

        </tr>
          <?php
            foreach($registros as $registro){
              echo "<tr><td>".$registro["ctgid"]."</td>";
              echo "<td>".$registro["ctgdsc"]."</td>";
              echo "<td>".$registro["ctgest"]."</td></tr>";
        }
          ?>
      </table>
    </div>
  </body>
</html>
