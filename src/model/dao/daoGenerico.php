<?php

abstract class daoGenerico{

	private $entityManager;

	/**
	 * Class Constructor
	 * @param    $entityManager   
	 */
	public function __construct()
	{
		require("bootstrap.php");

		$this->entityManager = $entityManager;
	}


	/**
     * @return mixed
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

	function listAll($nombre){
		$repositorio = 'model\dto\\'.$nombre;
	    $repository = $this->getEntityManager()->getRepository($repositorio);
	        //->find($id);
		
	    $entityList = $repository->findAll();
		
	    if (!$entityList) {
	        throw $this->createNotFoundException(
	            'No product found'
	        );
	    }
	    return $entityList;
	}

	function findByIdYoutube($nombre, $entity){
		$existe = true;
		$repositorio = 'model\dto\\'.$nombre;
	    $repository = $this->getEntityManager()->getRepository($repositorio);
	        //->find($id);
		
	    $entity = $repository->findOneBy(array('idYoutube' => $entity->getIdYoutube()));
		
	    return $entity;
	}	

	function insert($entity){
	    $entityM= $this->getEntityManager();
	        //->find($id);
	    $entityM->merge($entity);
	    $entityM->flush();
	}
    
}
?>