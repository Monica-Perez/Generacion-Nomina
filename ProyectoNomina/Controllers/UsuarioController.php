<?php
require_once __DIR__ . '/../Models/UsuarioModelo.php';

class UsuarioController {

    private $usuarios;

    public function __construct() {
        $this->usuarios = new UsuarioModelo(db::conectar());
    }

    public function ver() {
        $usuarios = $this->usuarios->obtenerUsuarios();
        require_once 'Views/Usuarios/Ver.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'ID_Emp' => $_POST['ID_Emp'],
                'Nombre_Usuario' => $_POST['Nombre_Usuario'],
                'Contrasena' => password_hash($_POST['Contrasena'], PASSWORD_DEFAULT),
                'Rol' => $_POST['Rol'],
                'Pregunta1' => $_POST['Pregunta1'],
                'Respuesta1' => $_POST['Respuesta1'],
                'Pregunta2' => $_POST['Pregunta2'],
                'Respuesta2' => $_POST['Respuesta2'],
                'Pregunta3' => $_POST['Pregunta3'],
                'Respuesta3' => $_POST['Respuesta3'],
                'Pregunta4' => $_POST['Pregunta4'],
                'Respuesta4' => $_POST['Respuesta4']
            ]; 

            try {
                $this->usuarios->crearUsuario($datos);
                header("Location: index.php?controller=usuario&action=ver&mensaje=Usuario creado");
                exit;
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        } else {
            $empleados = $this->usuarios->obtenerEmpleadosRH();
            include 'Views/Usuarios/Crear.php';
        }
    }

    public function editar() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=usuario&action=ver");
            exit;
        }

        $id = (int) $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'ID_Usuario' => $id,
                'Nombre_Usuario' => $_POST['Nombre_Usuario'],
                'Rol' => $_POST['Rol'],
                'Contrasena' => !empty($_POST['Contrasena']) ? password_hash($_POST['Contrasena'], PASSWORD_DEFAULT) : null,
                'Pregunta1' => $_POST['Pregunta1'],
                'Respuesta1' => $_POST['Respuesta1'],
                'Pregunta2' => $_POST['Pregunta2'],
                'Respuesta2' => $_POST['Respuesta2'],
                'Pregunta3' => $_POST['Pregunta3'],
                'Respuesta3' => $_POST['Respuesta3'],
                'Pregunta4' => $_POST['Pregunta4'],
                'Respuesta4' => $_POST['Respuesta4']
            ];

            $this->usuarios->actualizar($datos);
            header("Location: index.php?controller=usuario&action=ver&status=updated");
            exit;
        } else {
            $usuario = $this->usuarios->obtenerUsuarioPorId($id);
            include 'Views/Usuarios/Editar.php';
        }
    }


}
