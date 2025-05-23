<?php
require_once __DIR__ . '/../Models/LoginModelo.php';

require_once 'Models/LoginModelo.php';

class LoginController {
    private $login;

    public function __construct() {
        $this->login = new LoginModelo(db::conectar()); 
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $this->login->autenticar($_POST['Nombre_Usuario']);

            if (!$usuario || !password_verify($_POST['Contrasena'], $usuario['Contrasena'])) {
                $error = "Usuario o contraseña incorrectos.";
            } elseif ($usuario['Estado'] !== 'activo' || $usuario['Estado_Emp'] !== 'Activo') {
                $error = "Este usuario está inactivo.";
            } else {
                $_SESSION['ID_Usuario'] = $usuario['ID_Usuario'];
                $_SESSION['Nombre_Usuario'] = $usuario['Nombre_Usuario'];
                $_SESSION['Rol'] = $usuario['Rol'];
                $_SESSION['Nombre_Empleado'] = $usuario['Nombre_Empleado'];

                header("Location: index.php?controller=dashboard&action=index");
                exit;

            }
        }

        include 'Views/Login/Login.php';
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        session_destroy();

        header("Location: index.php?controller=login&action=login&cerrado=1");
        exit;
    }

    public function restaurar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['Nombre_Usuario']) && !isset($_POST['NuevaContrasena'])) {
                $datos = $this->login->obtenerPreguntasYRespuestas($_POST['Nombre_Usuario']);
                if ($datos) {
                    if ($datos['Estado'] !== 'activo') {
                        $error = "El usuario esta inactivo y no puede recuperar la contraseña.";
                        include 'Views/Login/Restaurar.php';
                        return;
                    }

                    include 'Views/Login/Preguntas.php';
                    return;
                }
            } elseif (isset($_POST['NuevaContrasena'])) {
                $datos = $this->login->obtenerPreguntasYRespuestas($_POST['Nombre_Usuario']);

                $correctas = strtolower(trim($_POST['Respuesta1'])) === strtolower(trim($datos['Respuesta1'])) &&
                            strtolower(trim($_POST['Respuesta2'])) === strtolower(trim($datos['Respuesta2'])) &&
                            strtolower(trim($_POST['Respuesta3'])) === strtolower(trim($datos['Respuesta3'])) &&
                            strtolower(trim($_POST['Respuesta4'])) === strtolower(trim($datos['Respuesta4']));

                if ($correctas) {
                    $hash = password_hash($_POST['NuevaContrasena'], PASSWORD_DEFAULT);
                    $this->login->actualizarContrasena($datos['ID_Usuario'], $hash);
                    header("Location: index.php?controller=login&action=login&recuperado=1");
                    exit;
                } else {
                    $error = "Respuestas incorrectas.";
                    include 'Views/Login/Login.php';
                    return;
                }
            }
        }

        include 'Views/Login/Restaurar.php';
    }

}

