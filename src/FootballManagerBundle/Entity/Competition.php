<?php

namespace FootballManagerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;

/**
 * Competition
 *
 * @ORM\Table(name="competition")
 * @ORM\Entity(repositoryClass="FootballManagerBundle\Repository\CompetitionRepository")
 * @ExclusionPolicy("none")
 */
class Competition
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
     * @ORM\Column(name="name", type="string", length=50, unique=true)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="TeamRegistration", mappedBy="competition")
     * @Exclude
     */
    private $registeredTeams;

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
        $this->registeredTeams = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Competition
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
     * Add registeredTeam
     *
     * @param \FootballManagerBundle\Entity\TeamRegistration $registeredTeam
     *
     * @return Competition
     */
    public function addRegisteredTeam(\FootballManagerBundle\Entity\TeamRegistration $registeredTeam)
    {
        $this->registeredTeams[] = $registeredTeam;

        return $this;
    }

    /**
     * Remove registeredTeam
     *
     * @param \FootballManagerBundle\Entity\TeamRegistration $registeredTeam
     */
    public function removeRegisteredTeam(\FootballManagerBundle\Entity\TeamRegistration $registeredTeam)
    {
        $this->registeredTeams->removeElement($registeredTeam);
    }

    /**
     * Get registeredTeams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRegisteredTeams()
    {
        return $this->registeredTeams;
    }

    public function getTeamsWithRegisteredPlayers()
    {
        $teams = [];

        foreach ($this->getRegisteredTeams() as $registeredTeam) {
            if ($registeredTeam->getRegisteredPlayers()->count() > 0) {
                $teams[] = $registeredTeam->getTeam();
            }
        }

        return $teams;
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
