<?php

namespace FootballManagerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;

/**
 * Player
 *
 * @ORM\Table(name="player")
 * @ORM\Entity(repositoryClass="FootballManagerBundle\Repository\PlayerRepository")
 * @ExclusionPolicy("none")
 */
class Player
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=100)
     */
    private $surname;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PlayerRegistration", mappedBy="player")
     * @Exclude
     */
    private $playerRegistrations;

    /**
     * @var Team
     *
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="players")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     * @Exclude
     */
    private $team;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->playerRegistrations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Player
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
     *
     * @return Player
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
     * Add playerRegistration
     *
     * @param \FootballManagerBundle\Entity\PlayerRegistration $playerRegistration
     *
     * @return Player
     */
    public function addPlayerRegistration(\FootballManagerBundle\Entity\PlayerRegistration $playerRegistration)
    {
        $this->playerRegistrations[] = $playerRegistration;

        return $this;
    }

    /**
     * Remove playerRegistration
     *
     * @param \FootballManagerBundle\Entity\PlayerRegistration $playerRegistration
     */
    public function removePlayerRegistration(\FootballManagerBundle\Entity\PlayerRegistration $playerRegistration)
    {
        $this->playerRegistrations->removeElement($playerRegistration);
    }

    /**
     * Get playerRegistration
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayerRegistrations()
    {
        return $this->playerRegistrations;

    }

    /**
     * Set team
     *
     * @param \FootballManagerBundle\Entity\Team $team
     *
     * @return Player
     */
    public function setTeam(\FootballManagerBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \FootballManagerBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimestamps()
    {
        $this->updatedAt = new \DateTime('now');

        if ($this->getCreatedAt() == null) {
            $this->createdAt = new \DateTime('now');
        }
    }
}
