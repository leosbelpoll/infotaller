<?php

namespace App\Repository;
use Doctrine\ORM\EntityRepository;

class FileRepository extends EntityRepository
{
    public function findImagenVehiculo($vehiculo){
        $em = $this->getEntityManager();

        $consulta = $em->createQuery('SELECT f FROM App:File f WHERE f.tipo = \'Imágenes\' AND f.vehiculo = :vehiculo');
        $consulta->setParameter('vehiculo', $vehiculo);
        $consulta->setMaxResults(1);
        return $consulta->getResult();
    }

    public function findAllPorVehiculo($vehiculos)
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT f FROM App:File f JOIN f.vehiculo v  WHERE f.vehiculo IN (:vehiculos)');
        $consulta->setParameter('vehiculos', $vehiculos);
        return $consulta->getResult();
    }
}