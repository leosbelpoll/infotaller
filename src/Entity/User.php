<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;  

/**
* Entidad para la gestion de usuarios
* 
* @ORM\Entity
* @ORM\Table(name="fos_user")
* @ORM\Entity(repositoryClass="App\Repository\UserRepository")
*/
class User extends BaseUser
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
     * Valido que la contrasenna cumpla las siguientes condiciones:
     *  - entre 6 y 19 caracteres
     *  - que contenga mayusculas y munisculas, numeros y caracteres especiales
     * 
     * @Assert\Length(
     *     min=6,
     *     max=19,
     *     minMessage="user.password.short",
     *     groups={"Profile", "ResetPassword", "Registration", "ChangePassword"}
     * )
     * @Assert\Regex(
     *     pattern="/^(?=.*[A-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^*(),.?+-])\S{9,16}$/",
     *     message="user.password.difficulty",
     *     groups={"Profile", "ResetPassword", "Registration", "ChangePassword"}
     * )
     */
    
    protected $plainPassword;

}