<?php

class UserModel
{
    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //constructor


    public function initSessionSuperuser($username, $password)
    {
        $consult = $this->db->prepare("CALL sp_buscar_usuario(?)");
        $consult->bindParam(1, $username);
        $consult->execute();
        $resultado = $consult->fetch(PDO::FETCH_ASSOC);
        if ($resultado && password_verify($password, $resultado['contrasena_usuario']) && $resultado['is_active'] == 1 && $resultado['tipo_usuario'] == 4) {
            return $resultado['cambiado'];
        } else {
            return false; // Contraseña incorrecta o usuario no encontrado
        }
    } //initSessionSuperuser


    public function changePasswordSuperuser($username, $password)
    {
        $passwordEncrypted = password_hash($password, PASSWORD_DEFAULT);
        $consult = $this->db->prepare("CALL sp_actualizar_contrasena(?,?)");
        $consult->bindParam(1, $username);
        $consult->bindParam(2, $passwordEncrypted);
        $consult->execute();
        $rowCount = $consult->rowCount(); // Obtener el número de filas afectadas por la consulta
        if ($rowCount > 0) {
            return true; // Registro exitoso
        } else {
            return false; // Error en el registro
        }
    }

    public function getUsers()
    {
        $consult = $this->db->prepare("CALL sp_obtener_usuarios()");
        $consult->execute();
        $resultado = $consult->fetchAll();
        return $resultado;
    } //getUsers

    public function initSessionUser($username, $password)
    {
        $consult = $this->db->prepare("CALL sp_buscar_usuario(?)");
        $consult->bindParam(1, $username);
        $consult->execute();
        $resultado = $consult->fetch(PDO::FETCH_ASSOC);

        if ($resultado && password_verify($password, $resultado['contrasena_usuario']) && $resultado['is_active'] == 1) {
            return $resultado['tipo_usuario'];
        } else {
            return 0; // Contraseña incorrecta o usuario no encontrado
        }
    }

    public function verifySuperUser($username)
    {
        $consult = $this->db->prepare("CALL sp_buscar_usuario(?)");
        $consult->bindParam(1, $username);

        $consult->execute();
        $resultado = $consult->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return true;
        } else {
            return false; // Contraseña incorrecta o usuario no encontrado
        }
    } //verifySuperUser

    public function registerSuperUser($username, $password, $role)
    {

        $passwordEncrypted = password_hash($password, PASSWORD_DEFAULT);
        $consult = $this->db->prepare("CALL sp_registrar_usuario(?, ?, ?)");
        $consult->bindParam(1, $username);
        $consult->bindParam(2, $passwordEncrypted);
        $consult->bindParam(3, $role);

        $consult->execute();

        $rowCount = $consult->rowCount(); // Obtener el número de filas afectadas por la consulta

        if ($rowCount > 0) {
            return true; // Registro exitoso
        } else {
            return false; // Error en el registro
        }
    } //registerSuperUser

    public function registerUser($username, $password, $role)
    {

        $passwordEncrypted = password_hash($password, PASSWORD_DEFAULT);
        $consult = $this->db->prepare("CALL sp_registrar_usuario(?, ?, ?)");
        $consult->bindParam(1, $username);
        $consult->bindParam(2, $passwordEncrypted);
        $consult->bindParam(3, $role);

        $consult->execute();

        $rowCount = $consult->rowCount(); // Obtener el número de filas afectadas por la consulta

        if ($rowCount > 0) {
            return true; // Registro exitoso
        } else {
            return false; // Error en el registro
        }

    }

    public function registerAdmin($username, $password, $role)
    {
        $passwordEncrypted = password_hash($password, PASSWORD_DEFAULT);
        $consult = $this->db->prepare("CALL sp_registrar_usuario(?, ?, ?)");
        $consult->bindParam(1, $username);
        $consult->bindParam(2, $passwordEncrypted);
        $consult->bindParam(3, $role);
        $consult->execute();

        $rowCount = $consult->rowCount();

        if ($rowCount > 0) {
            return true; // Registro exitoso
        } else {
            return false; // Error en el registro
        }
    } //registerUser
    public function activateUser($usuario)
    {
        $consult = $this->db->prepare("CALL sp_desactivar_usuario(?)");
        $consult->bindParam(1, $usuario);
        $consult->execute();
        return true;
    } //registerUser

    public function listUser()
    {
        $consult = $this->db->prepare("CALL sp_listar_usuarios");
        $consult->execute();
        $result = $consult->fetchAll();
        $consult->closeCursor();
        return $result;
    }
} //class IndexController


?>