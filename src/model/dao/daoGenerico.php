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

    abstract public function listAll();

	protected function listarTodo($nombre){
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

	abstract public function findById($id);

	function buscarPorId($nombre, $id){
		$repositorio = 'model\dto\\'.$nombre;
	    $repository = $this->getEntityManager()->getRepository($repositorio);
		
	    $entity = $repository->find($id);
		
	    return $entity;
	}

	abstract public function findByIdYoutube($entity);

	function buscarPorIdYoutube($nombre, $entity){
		$repositorio = 'model\dto\\'.$nombre;
	    $repository = $this->getEntityManager()->getRepository($repositorio);
	        //->find($id);
		
	    $entity = $repository->findOneBy(array('idYoutube' => $entity->getIdYoutube()));
		
	    return $entity;
	}	

	abstract public function insert($entity);

	function insertar($entity){
	    $entityM= $this->getEntityManager();
	        //->find($id);
	    $entityM->merge($entity);
	    $entityM->flush();
	}
    
}
?>