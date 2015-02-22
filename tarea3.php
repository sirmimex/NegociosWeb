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
    $registro["Costo"]=$_POST["txtcosto"];
    $registro["Cantidad"]=$_POST["txtcantidad"];
    $registro["Estado"]=$_POST["optestado"];
    $registro["Categoria"]=$_POST["txtcategoria"];

    $sqlinsert ="INSERT INTO `productos` ( `prddsc`, `prdbrc`, `prdctd`, `prdest`, `ctgid`)";
    $sqlinsert.="VALUES ('". $registro["Descripcion"] ."' , '". $registro["Costo"] ."' , '". $registro["Cantidad"] ."' , '". $registro["Estado"] ."' , '". $registro["Categoria"] ."');";
    $result = $conexion->query($sqlinsert);
  }


    if(isset($_POST[btnmodificar])){
      if($_POST[txtdescripcion]!=""){
        $modifi="update productos set prddsc= '". $_POST["txtdescripcion"] ."' where prdid='".$_POST["txtidmodificar"]."'";
        $result2 = $conexion->query($modifi);
      }
      if($_POST[txtcosto]!=""){
        $modifi="update productos set prdbrc= '". $_POST["txtcosto"] ."' where prdid='".$_POST["txtidmodificar"]."'";
        $result2 = $conexion->query($modifi);
      }
      if($_POST[txtcantidad]!=""){
        $modifi="update productos set prdctd= '". $_POST["txtcantidad"] ."' where prdid='".$_POST["txtidmodificar"]."'";
        $result2 = $conexion->query($modifi);
      }
      if($_POST[optestado]!=""){
        $modifi="update productos set prdest= '". $_POST["optestado"] ."' where prdid='".$_POST["txtidmodificar"]."'";
        $result2 = $conexion->query($modifi);
      }
      if($_POST[txtcategoria]!=""){
        $modifi="update productos set ctgid= '". $_POST["txtcategoria"] ."' where prdid='".$_POST["txtidmodificar"]."'";
        $result2 = $conexion->query($modifi);
      }

  }
  $lasInsertID = $conexion->insert_id;
  $sqlQuery = "Select * from productos;";

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
    <h1>Tarea 3</h1>
    <h2>Tabla de Productos</h2>
    <form action="tarea3.php" method="POST">
      <label for="txtdescripcion">Descripcion</label>
      <input type="text" name="txtdescripcion"/>
      <br>
      <label for="txtcosto">Costo</label>
      <input type="text" name="txtcosto"/>
      <br>
      <label for="txtcantidad">Cantidad</label>
      <input type="text" name="txtcantidad"/>
      <br>
      <label for="optestado">Estado</label>
      <select name="optestado" id="estado">
        <option value="act">Activo</option>
        <option value="des">desactivo</option>
      </select>
      <br>
      <label for="txtcategoria">Cateoria</label>
      <input type="text" name="txtcategoria"/>
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
          <th>Costo</th>
          <th>Cantidad</th>
          <th>Estado</th>
          <th>Categoria</th>
        </tr>
          <?php
            foreach($registros as $registro){
              echo "<tr><td>".$registro["prdid"]."</td>";
              echo "<td>".$registro["prddsc"]."</td>";
              echo "<td>".$registro["prdbrc"]."</td>";
              echo "<td>".$registro["prdctd"]."</td>";
              echo "<td>".$registro["prdest"]."</td>";
              echo "<td>".$registro["ctgid"]."</td></tr>";

        }
          ?>
      </table>
    </div>
  </body>
</html>
