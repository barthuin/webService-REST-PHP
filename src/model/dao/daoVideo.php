<?php
require_once('./src/model/dao/daoGenerico.php');

class daoVideo extends daoGenerico{
	public function listAll(){
		return parent::listarTodo('Videos');
	}

	public function findById($id){
		return parent::buscarPorId('Videos', $id);
	}

	public function findByIdYoutube($entity){
		return parent::buscarPorIdYoutube('Videos', $entity);
	}
    
    public function insert($entity){
		return parent::insertar($entity);
	}	

	public function findByIdCanal($idCanal){
		$qb = parent::getEntityManager()->createQueryBuilder();

		$qb->select('v')->from('model\dto\Videos','v')
					->innerjoin('model\dto\Playlist','p','WITH', 'v.idPlaylist = p.id')
 					->innerjoin('model\dto\Canales','c','WITH', 'p.idcanal = c.id')
 					->where('c.id = :idCanal')
 					->setParameter('idCanal', $idCanal);

 		$query = $qb->getQuery();
 		return $query->getResult();
	}
}
?>