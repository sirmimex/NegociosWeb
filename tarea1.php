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
    $registro["Email"]=$_POST["txtemail"];
    $registro["Telefono"]=$_POST["txttelefono"];
    $registro["Contacto"]=$_POST["txtcontacto"];
    $registro["Direccion"]=$_POST["txtdireccion"];
    $registro["Estado"]=$_POST["optestado"];

    $sqlinsert ="INSERT INTO `proveedores` ( `prvdsc`, `prvemail`, `prvtel`, `prvcont`, `prvdir`, `prvest`)";
    $sqlinsert.="VALUES ('". $registro["Descripcion"] ."' , '". $registro["Email"] ."' , '". $registro["Telefono"] ."' , '". $registro["Contacto"] ."' , '". $registro["Direccion"] ."' , '". $registro["Estado"] ."');";
    $result = $conexion->query($sqlinsert);
  }


    if(isset($_POST[btnmodificar])){
      if($_POST[txtdescripcion]!=""){
        $modifi="update proveedores set prvdsc= '". $_POST["txtdescripcion"] ."' where prvid='".$_POST["txtidmodificar"]."'";
        $result2 = $conexion->query($modifi);
      }
      if($_POST[txtemail]!=""){
        $modifi="update proveedores set prvemail= '". $_POST["txtemail"] ."' where prvid='".$_POST["txtidmodificar"]."'";
        $result2 = $conexion->query($modifi);
      }
      if($_POST[txttelefono]!=""){
        $modifi="update proveedores set prvtel= '". $_POST["txttelefono"] ."' where prvid='".$_POST["txtidmodificar"]."'";
        $result2 = $conexion->query($modifi);
      }
      if($_POST[txtcontacto]!=""){
        $modifi="update proveedores set prvcont= '". $_POST["txtcontacto"] ."' where prvid='".$_POST["txtidmodificar"]."'";
        $result2 = $conexion->query($modifi);
      }
      if($_POST[txtdireccion]!=""){
        $modifi="update proveedores set prvdir= '". $_POST["txtdireccion"] ."' where prvid='".$_POST["txtidmodificar"]."'";
        $result2 = $conexion->query($modifi);
      }
      //$estado="select prvest from proveedores where prvid='". $_POST["txtidmodificar"] ."'"
      if($_POST[optestado]!=""){
        $modifi="update proveedores set prvest= '". $_POST["optestado"] ."' where prvid='".$_POST["txtidmodificar"]."'";
        $result2 = $conexion->query($modifi);
      }


  }
  $lasInsertID = $conexion->insert_id;
  $sqlQuery = "Select * from proveedores;";

  $resulCursor = $conexion->query($sqlQuery);

  while($registro = $resulCursor->fetch_assoc()){
    $registros[] = $registro;
  }


?>
<html>
  <head>
    <title>Tarea1</title>
  </head>
  <body>
    <h1>Tarea 1</h1>
    <h2>Tabla de proveedores</h2>
    <form action="tarea1.php" method="POST">
      <label for="txtdescripcion">Descripcion</label>
      <input type="text" name="txtdescripcion"/>
      <br>
      <label for="txtemail">Email</label>
      <input type="text" name="txtemail"/>
      <br>
      <label for="txttelefono">Telefono</label>
      <input type="text" name="txttelefono"/>
      <br>
      <label for="txtcontacto">Contacto</label>
      <input type="text" name="txtcontacto"/>
      <br>
      <label for="txtdireccion">Direccion</label>
      <input type="text" name="txtdireccion"/>
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
          <th>Email</th>
          <th>Telefono</th>
          <th>Contacto</th>
          <th>Direccion</th>
          <th>Estado</th>

        </tr>
          <?php
            foreach($registros as $registro){
              echo "<tr><td>".$registro["prvid"]."</td>";
              echo "<td>".$registro["prvdsc"]."</td>";
              echo "<td>".$registro["prvemail"]."</td>";
              echo "<td>".$registro["prvtel"]."</td>";
              echo "<td>".$registro["prvcont"]."</td>";
              echo "<td>".$registro["prvdir"]."</td>";
              echo "<td>".$registro["prvest"]."</td></tr>";

        }
          ?>
      </table>
    </div>
  </body>
</html>
