<?php

namespace App\Repository;
use Doctrine\ORM\EntityRepository;

/**
 * Repositorio principal donde hago todas las consultas sobre los vehiculos
 */

class VehiculoRepository extends EntityRepository
{

    /**
     * Encontrar todos los vehiculos dada una clase
     */
    public function findAllPorClase($clase){
        $em = $this->getEntityManager('despiece');

        $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v JOIN v.clase c WHERE c.name = :clase');
        $consulta->setParameter('clase', $clase);
        return $consulta->getResult();
    }

    /**
     * Encontrar por la categoria de Coche dado los datos de vehiculo
     */
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
    
    /**
     * Encontrar por la categoria de Motocicleta dado los datos de vehiculo
     */
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

    /**
     * Encontrar los vehiculos que cumplan con los filtros especificados
     */
    public function findPorFiltro($marca, $tipo, $modelo, $anno){
        
        $em = $this->getEntityManager('despiece');
        if($tipo == -1){
            // Si solo llega marca
            $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v WHERE v.marca = :marca');
            $consulta->setParameters([
                'marca'     => $marca,
            ]);
        } else if($modelo == -1) {
            // Si llega solo marca y tipo
            $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v WHERE v.marca = :marca AND v.tipo = :tipo');
            $consulta->setParameters([
                'marca'     => $marca,
                'tipo'      => $tipo,
            ]);
        } else if($anno == -1){
            // Si llega solo marca, tipo y modelo
            $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v WHERE v.marca = :marca AND v.tipo = :tipo AND v.modelo = :modelo');
            $consulta->setParameters([
                'marca'     => $marca,
                'tipo'      => $tipo,
                'modelo'    => $modelo,
            ]);
        } else {
            // Si llegan todos los filtros
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

    /**
     * Encontrar todos los vehiculos subidos en un tiempo especificado
     */
    public function findVehiculosSubidos($tiempo){
        $fecha = new \DateTime();
        $fecha->modify($tiempo);
        $em = $this->getEntityManager('despiece');

        $consulta = $em->createQuery('SELECT v FROM App:Vehiculo v WHERE v.creacion > :fecha AND v.estado = \'new\' ORDER BY v.creacion DESC');
        $consulta->setParameter('fecha', $fecha);
        return $consulta->getResult();
    }

    /**
     * Encontrar todos los vehiculos actualizados en un tiempo especificado
     */
    public function findVehiculosActualizados($tiempo){
        $fecha = new \DateTime();
        $fecha->modify($tiempo);
        $em = $this->getEntityManager('despiece');

        $consulta = $em->createQuery("SELECT v FROM App:Vehiculo v WHERE v.creacion > :fecha AND v.estado = 'edited' ORDER BY v.creacion DESC");
        $consulta->setParameter('fecha', $fecha);
        return $consulta->getResult();
    }

    /**
     * Encontrar todos los tipos dado una marca
     */
    public function findTiposPorMarca($marca){
        $em = $this->getEntityManager('despiece');
        $consulta = $em->createQuery("SELECT t FROM App:Tipo t INNER JOIN App:Vehiculo v WITH t = v.tipo WHERE v.marca = :marca GROUP BY t");
        $consulta->setParameter('marca', $marca);

        return $consulta->getArrayResult();
    }

    /**
     * Encontrar todos los modelos dado un tipo
     */
    public function findModelosPorTipo($tipo){
        $em = $this->getEntityManager('despiece');
        $consulta = $em->createQuery("SELECT v FROM App:vehiculo v INNER JOIN App:Tipo t WITH t = v.tipo WHERE t.id = :tipo GROUP BY v");
        $consulta->setParameter('tipo', $tipo);

        return $consulta->getArrayResult();
    }

    /**
     * Encontrar todos los annos dado un modelo
     */
    public function findAnnosPorModelo($modelo){
        $em = $this->getEntityManager('despiece');
        $consulta = $em->createQuery("SELECT v FROM App:vehiculo v WHERE v.modelo = :modelo GROUP BY v");
        $consulta->setParameter('modelo', $modelo);

        return $consulta->getArrayResult();
    }
}