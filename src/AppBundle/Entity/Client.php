<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AppAssert;
/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ClientRepository")
 * @ORM\Table(name="client")
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     /**
     * @Assert\NotBlank()
     * @ORM\Column(type="integer")
     */
    protected $idCardType;
    /**
     * @Assert\NotBlank()
     * @AppAssert\SpanishId
     * @ORM\Column(type="string", length=9, unique=true)
     */
    protected $idCardNumber;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100)
     */
    protected $name;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100)
     */
    protected $surname;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    protected $email;

    /**
     * @ORM\OneToMany(targetEntity="Membership", mappedBy="client")
     */
    protected $memberships;

    /**
     * @ORM\OneToMany(targetEntity="Access", mappedBy="client")
     */
    protected $access;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->memberships = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function __toString(){
        return $this->getName().','.$this->getSurname();
    }
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idCardType
     *
     * @param integer $idCardType
     * @return Client
     */
    public function setIdCardType($idCardType)
    {
        $this->idCardType = $idCardType;

        return $this;
    }

    /**
     * Get idCardType
     *
     * @return integer 
     */
    public function getIdCardType()
    {
        return $this->idCardType;
    }

    /**
     * Set idCardNumber
     *
     * @param string $idCardNumber
     * @return Client
     */
    public function setIdCardNumber($idCardNumber)
    {
        $this->idCardNumber = $idCardNumber;

        return $this;
    }

    /**
     * Get idCardNumber
     *
     * @return string 
     */
    public function getIdCardNumber()
    {
        return $this->idCardNumber;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Client
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return Client
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }



    /**
     * Add memberships
     *
     * @param \AppBundle\Entity\Membership $memberships
     * @return Client
     */
    public function addMembership(\AppBundle\Entity\Membership $memberships)
    {
        $this->memberships[] = $memberships;

        return $this;
    }

    /**
     * Remove memberships
     *
     * @param \AppBundle\Entity\Membership $memberships
     */
    public function removeMembership(\AppBundle\Entity\Membership $memberships)
    {
        $this->memberships->removeElement($memberships);
    }

    /**
     * Get memberships
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMemberships()
    {
        return $this->memberships;
    }




    /**
     * Add access
     *
     * @param \AppBundle\Entity\Access $access
     * @return Client
     */
    public function addAccess(\AppBundle\Entity\Access $access)
    {
        $this->access[] = $access;

        return $this;
    }

    /**
     * Remove access
     *
     * @param \AppBundle\Entity\Access $access
     */
    public function removeAccess(\AppBundle\Entity\Access $access)
    {
        $this->access->removeElement($access);
    }

    /**
     * Get access
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Client
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
}
