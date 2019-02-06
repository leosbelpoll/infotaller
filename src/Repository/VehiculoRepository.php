<?php

namespace App\Repository;
use Doctrine\ORM\EntityRepository;

class VehiculoRepository extends EntityRepository
{

    public function findAllPorClase($clase){
        $em = $this->getEntityManager();

        $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v JOIN v.clase c WHERE c.name = :clase');
        $consulta->setParameter('clase', $clase);
        return $consulta->getResult();
    }

    public function findCoche($vehiculo){
        $em = $this->getEntityManager();

        $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v JOIN v.clase c WHERE c.name = :clase and v.id = :vehiculo');
        $consulta->setParameter('clase', 'Coche');
        $consulta->setParameter('vehiculo', $vehiculo);
        $resultado = $consulta->getResult();
        if(!$resultado){
            return null;
        }
        return $resultado[0];
    }
    
    public function findMoto($vehiculo){
        $em = $this->getEntityManager();
        
        $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v JOIN v.clase c WHERE c.name = :clase and v.id = :vehiculo');
        $consulta->setParameter('clase', 'Motocicleta');
        $consulta->setParameter('vehiculo', $vehiculo);
        $resultado = $consulta->getResult();
        if(!$resultado){
            return null;
        }
        return $resultado[0];
    }

    public function findPorFiltro($marca, $tipo, $modelo, $anno){
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v WHERE v.marca = :marca AND v.tipo = :tipo AND v.modelo = :modelo AND v.creacion BETWEEN :anno1 AND :anno2');
        $consulta->setParameters([
            'marca'     => $marca,
            'tipo'      => $tipo,
            'modelo'    => $modelo,
            'anno1'      => $anno.'-1-1',
            'anno2'      => $anno.'-12-31'
        ]);
        return $consulta->getResult();
    }

    public function findVehiculosSubidos($tiempo){
        $fecha = new \DateTime();
        $fecha->modify($tiempo);
        $em = $this->getEntityManager();

        $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v WHERE v.creacion > :fecha ORDER BY v.creacion DESC');
        $consulta->setParameter('fecha', $fecha);
        return $consulta->getResult();
    }

    public function findVehiculosActualizados($tiempo){
        $fecha = new \DateTime();
        $fecha->modify($tiempo);
        $em = $this->getEntityManager();

        $consulta = $em->createQuery("SELECT v FROM App:Vehiculo v WHERE v.creacion > :fecha AND v.estado = 'actualizado' ORDER BY v.creacion DESC");
        $consulta->setParameter('fecha', $fecha);
        return $consulta->getResult();
    }
}