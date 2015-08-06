<?php
/**
 * Created by PhpStorm.
 * User: salif.guigma
 * Date: 8/6/15
 * Time: 2:27 PM
 */

namespace AppBundle\Entity;


class Client
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="integer")
     */
    protected $idCardType;
    /**
     * @ORM\Column(type="string", length=9)
     */
    protected $idCardNumber;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $surname;
    /**
     * @ORM\Column(type="date")
     */
    protected $birthdate;
}