<?php
    include 'includes/app.php';

    template("header");

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $user = $_POST["user"];
        $password = $_POST["password"];

        try {
            $conexion = new PDO("mysql: host=localhost; dbname=magictech", "root", "K-jh564.*");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT * FROM usuarios WHERE usuario= :user ";
            $consulta = $conexion->prepare($query);
            $consulta->bindValue(":user", $user);
            $consulta->execute();

                if($consulta->rowCount()!=0) {
                $registro = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
                foreach($registro as $usuario) {
                    $datosUsuario = $usuario;
                }

                if(password_verify($password, $datosUsuario["clave"])) {
                    session_start();
                    $_SESSION["usuario"] = $user;
                    $_SESSION["login"] = true;
                    header("location: admin/index.php");
                }
                }
        }
        catch(Exception $e) {
            echo "ERROR: " . $e->getMessage();
        }

    }
?>

<main class="contenedorSmall contacto">
    <h2>Ingrese</h2>

    <form method="post">
        <div class="contenedor_contacto" style="max-width: 50rem; margin: 0 auto;">
            <label for="user">Tu Usuario</label>
            <input type="text" id="user" name="user" class="inputs_contacto">
            <label for="password">Tu Contraseña</label>
            <input type="text" id="password" name="password" class="inputs_contacto">
        </div>
        <input type="submit" class="btn verde">
    </form>
</main>

<?php
    include 'includes/template/footer.php';
?>