<?php


namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AccessRepository")
 * @ORM\Table(name="access")
 */
class Access
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
  protected  $id;
    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="access")
     */
  protected  $client;
    /**
     * @ORM\Column(type="integer")
     */
  protected  $locker;
    /**
     * @ORM\Column(type="datetime")
     */
  protected  $startDate;
    /**
     * @ORM\Column(type="datetime")
     */
  protected  $endDate;

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
     * Set locker
     *
     * @param integer $locker
     * @return Access
     */
    public function setLocker($locker)
    {
        $this->locker = $locker;

        return $this;
    }

    /**
     * Get locker
     *
     * @return integer 
     */
    public function getLocker()
    {
        return $this->locker;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Access
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
     * @return Access
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
     * @return Access
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
}
