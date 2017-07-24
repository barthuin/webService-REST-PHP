<?php
require_once('./src/model/dao/daoGenerico.php');

class daoCanal extends daoGenerico{
	public function listAll(){
		return parent::listarTodo('Canales');
	}

	public function findById($id){
		return parent::buscarPorId('Canales', $id);
	}

	public function findByIdYoutube($entity){
		return parent::buscarPorIdYoutube('Canales', $entity);
	}
    
    public function insert($entity){
		return parent::insertar($entity);
	}
}
?>