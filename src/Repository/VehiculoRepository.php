<?php

namespace App\Repository;
use Doctrine\ORM\EntityRepository;

class VehiculoRepository extends EntityRepository
{

    public function findAllPorClase($clase){
        $em = $this->getEntityManager('despiece');

        $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v JOIN v.clase c WHERE c.name = :clase');
        $consulta->setParameter('clase', $clase);
        return $consulta->getResult();
    }

    public function findCoche($vehiculo){
        $em = $this->getEntityManager('despiece');

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
        $em = $this->getEntityManager('despiece');
        
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
        $em = $this->getEntityManager('despiece');
        if($tipo == -1){
            $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v WHERE v.marca = :marca');
            $consulta->setParameters([
                'marca'     => $marca,
            ]);
        } else if($modelo == -1) {
            $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v WHERE v.marca = :marca AND v.tipo = :tipo');
            $consulta->setParameters([
                'marca'     => $marca,
                'tipo'      => $tipo,
            ]);
        } else if($anno == -1){
            $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v WHERE v.marca = :marca AND v.tipo = :tipo AND v.modelo = :modelo');
            $consulta->setParameters([
                'marca'     => $marca,
                'tipo'      => $tipo,
                'modelo'    => $modelo,
            ]);
        } else {
            $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v WHERE v.marca = :marca AND v.tipo = :tipo AND v.modelo = :modelo AND v.fechaInicio = :anno');
            $consulta->setParameters([
                'marca'     => $marca,
                'tipo'      => $tipo,
                'modelo'    => $modelo,
                'anno'      => $anno,
            ]);
        }

        return $consulta->getResult();
    }

    public function findVehiculosSubidos($tiempo){
        $fecha = new \DateTime();
        $fecha->modify($tiempo);
        $em = $this->getEntityManager('despiece');

        $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v WHERE v.creacion > :fecha ORDER BY v.creacion DESC');
        $consulta->setParameter('fecha', $fecha);
        return $consulta->getResult();
    }

    public function findVehiculosActualizados($tiempo){
        $fecha = new \DateTime();
        $fecha->modify($tiempo);
        $em = $this->getEntityManager('despiece');

        $consulta = $em->createQuery("SELECT v FROM App:Vehiculo v WHERE v.creacion > :fecha AND v.estado = 'actualizado' ORDER BY v.creacion DESC");
        $consulta->setParameter('fecha', $fecha);
        return $consulta->getResult();
    }

    public function findTiposPorMarca($marca){
        $em = $this->getEntityManager('despiece');
        $consulta = $em->createQuery("SELECT t FROM App:Tipo t INNER JOIN App:Vehiculo v WITH t = v.tipo WHERE v.marca = :marca");
        $consulta->setParameter('marca', $marca);

        return $consulta->getArrayResult();
    }

    public function findModelosPorTipo($tipo){
        $em = $this->getEntityManager('despiece');
        $consulta = $em->createQuery("SELECT v FROM App:vehiculo v INNER JOIN App:Tipo t WITH t = v.tipo WHERE t.id = :tipo");
        $consulta->setParameter('tipo', $tipo);

        return $consulta->getArrayResult();
    }

    public function findAnnosPorModelo($modelo){
        $em = $this->getEntityManager('despiece');
        $consulta = $em->createQuery("SELECT v FROM App:vehiculo v WHERE v.modelo = :modelo");
        $consulta->setParameter('modelo', $modelo);

        return $consulta->getArrayResult();
    }
}