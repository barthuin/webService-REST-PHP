<?php
require_once('./src/model/dao/daoGenerico.php');

class daoPlaylist extends daoGenerico{
	public function listAll(){
		return parent::listarTodo('Playlist');
	}

	public function findById($id){
		return parent::buscarPorId('Playlist', $id);
	}

	public function findByIdYoutube($entity){
		return parent::buscarPorIdYoutube('Playlist', $entity);
	}

	public function findByIdCanal($idCanal){
		$qb = parent::getEntityManager()->createQueryBuilder();

		$qb->select('p')->from('model\dto\Playlist','p')
 					->innerjoin('model\dto\Canales','c','WITH', 'p.idcanal = c.id')
 					->where('c.id = :idCanal')
 					->setParameter('idCanal', $idCanal);

 		$query = $qb->getQuery();
 		return $query->getResult();
	}
    
    public function insert($entity){
		return parent::insertar($entity);
	}
}
?>