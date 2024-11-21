<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="./css/styles.css">
    <script src="./procesos/validaciones.js"></script>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="./img/logoJ23.png" alt="Logo">
        </div>
        <div class="login-form">
            <h2>Iniciar Sesión</h2>
            <form id="loginForm" action="./procesos/login.php" method="POST">
                <div class="input-group">
                    <label for="user">Usuario:</label>
                    <input type="text" id="user" name="user" onblur="validarUser()" value="<?php
                                                                                            if (isset($_GET['user'])) {
                                                                                                echo $_GET['user'];
                                                                                            } else {
                                                                                                echo 'Juan';
                                                                                            }
                                                                                            ?>">
                    <p id="error_user" class="error" style="color:red;">
                        <?php
                        if (isset($_GET['userVacio'])) {
                            echo "campo obligatorio";
                        }
                        ?>
                    </p>
                </div>
                <div class="input-group">
                    <label for="pwd">Contraseña:</label>
                    <input type="password" id="pwd" name="pwd" onblur="validarPwd()" value="<?php
                                                                                            if (isset($_GET['pwd'])) {
                                                                                                echo $_GET['pwd'];
                                                                                            } else {
                                                                                                echo "asdASD123";
                                                                                            }
                                                                                            ?>">
                    <p id="error_pwd" class="error" style="color:red;">
                        <?php
                        if (isset($_GET['pwdVacio'])) {
                            echo "campo obligatorio";
                        }
                        if (isset($_GET['pwdMal']) || isset($_GET['userMal'])) {
                            echo "<br>Usuario o contraseña incorrectos";
                        }
                        ?>
                    </p>
                </div>

                <button type="submit" onclick="validacampos()">Ingresar</button>
            </form>
        </div>
    </div>
</body>

</html>