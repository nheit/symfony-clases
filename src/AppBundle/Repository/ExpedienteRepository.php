<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ExpedienteRepository extends EntityRepository{
    
    public function findEntreAnios($anioDesde, $anioHasta){
        return $this->getEntityManager()
                        ->createQuery('SELECT e FROM AppBundle:Expediente e WHERE e.anio >= :desde and e.anio<= :hasta')
                        ->setParameters(array('desde'=>$anioDesde, 'hasta'=>$anioHasta))
                        ->getResult();
    }
}
