<?php

class Usuario
{
    private $id_usuario;
    private $id_rol;
    private $usuario;
    private $contrasenia;
    private $activo;
    private $correo;
    private $intento_inicio;
    private $imagen_perfil;


    protected static function getTable()
    {
        return 'usuarios';
    }

    protected static function getPk()
    {
        return 'id_usuario';
    }

    protected static function getFk()
    {
        return ['Roles' => 'id_rol'];
    }

    /**
     * @return mixed
     */
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param mixed $id_usuario
     */
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * @return mixed
     */
    public function getId_rol()
    {
        return $this->id_rol;
    }

    /**
     * @param mixed $id_rol
     */
    public function setId_rol($id_rol)
    {
        $this->id_rol = $id_rol;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getContrasenia()
    {
        return $this->contrasenia;
    }

    /**
     * @param mixed $contrasenia
     */
    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }

    /**
     * @return mixed
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * @param mixed $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @return mixed
     */
    public function getIntento_inicio()
    {
        return $this->intento_inicio;
    }

    /**
     * @param mixed $intento_inicio
     */
    public function setIntento_inicio($intento_inicio)
    {
        $this->intento_inicio = $intento_inicio;
    }

    /**
     * @return mixed
     */
    public function getImagen_perfil()
    {
        return $this->imagen_perfil;
    }

    /**
     * @param mixed $imagen_perfil
     */
    public function setImagen_perfil($imagen_perfil)
    {
        $this->imagen_perfil = $imagen_perfil;
    }

    public function consultarAllUsuarios()
    {

        $result = 0;

        try {
            $db = new DB();
            $select = 'SELECT id_usuario,usuario FROM usuarios WHERE 1';
            $stmt = $db->getConn()->prepare($select);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function cargarAllProducts()
    {

        $result = 0;
        try {
            $db = new DB();
            $select = 'SELECT * FROM `productos` WHERE 1';
            $stmt = $db->getConn()->prepare($select);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $result;
    }



}