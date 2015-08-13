<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 *  @ORM\Entity(repositoryClass="AppBundle\Entity\MembershipRepository")
 * @ORM\Table(name="membership")
 */
class Membership
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
    protected $type;
    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="membserships")
     */
    protected $client;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $cardNumber;
    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     */
    protected $startDate;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $endDate;

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
     * Set type
     *
     * @param integer $type
     * @return Membership
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set cardNumber
     *
     * @param string $cardNumber
     * @return Membership
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * Get cardNumber
     *
     * @return string 
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Membership
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Membership
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     * @return Membership
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    public function isActive(){
        if($this->getEndDate()){
        $today = new \DateTime("now");
         if( !($this->getEndDate()->format('U') > $today->format('U'))){
             return 'No activo';
         }
        }
        return 'Activo';

    }
}
