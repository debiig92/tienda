<?php
class api_controller extends base_controller{

    public function cargarTodos(){
		$u = new Usuario();
		$usuarios = $u->consultarAllUsuarios();
        if(!empty($usuarios) && $usuarios != 0){
            echo $this->responseJSON(array('status' => 'success', 'result' => $usuarios));
        } else {
            echo $this->responseJSON(array('status' => 'error', 'result' => array()));
        }
    }

    public function cargarAllProducts(){
        $u = new Usuario();
        $usuarios = $u->cargarAllProducts();
        if(!empty($usuarios) && $usuarios != 0){
            echo $this->responseJSON(array('status' => 'success', 'result' => $usuarios));
        } else {
            echo $this->responseJSON(array('status' => 'error', 'result' => array()));
        }
    }


}