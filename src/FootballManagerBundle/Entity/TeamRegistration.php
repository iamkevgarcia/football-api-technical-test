<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 26/04/17
 * Time: 22:16
 */

namespace FootballManagerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TeamRegistration
 *
 * @ORM\Table(name="team_registration")
 * @ORM\Entity(repositoryClass="FootballManagerBundle\Repository\TeamRegistrationRepository")
 */
class TeamRegistration
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
     * @var Competition
     *
     * @ORM\ManyToOne(targetEntity="Competition", inversedBy="registeredTeams")
     * @ORM\JoinColumn(name="competition_id", referencedColumnName="id")
     */
    private $competition;

    /**
     * @var Team
     *
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="competitions")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    private $team;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PlayerRegistration", mappedBy="teamRegistration")
     */
    private $registeredPlayers;

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
        $this->registeredPlayers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set competition
     *
     * @param \FootballManagerBundle\Entity\Competition $competition
     *
     * @return TeamRegistration
     */
    public function setCompetition(\FootballManagerBundle\Entity\Competition $competition = null)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * Get competition
     *
     * @return \FootballManagerBundle\Entity\Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * Set team
     *
     * @param \FootballManagerBundle\Entity\Team $team
     *
     * @return TeamRegistration
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
     * Add registeredPlayer
     *
     * @param \FootballManagerBundle\Entity\PlayerRegistration $registeredPlayer
     *
     * @return TeamRegistration
     */
    public function addRegisteredPlayer(\FootballManagerBundle\Entity\PlayerRegistration $registeredPlayer)
    {
        $this->registeredPlayers[] = $registeredPlayer;

        return $this;
    }

    /**
     * Remove registeredPlayer
     *
     * @param \FootballManagerBundle\Entity\PlayerRegistration $registeredPlayer
     */
    public function removeRegisteredPlayer(\FootballManagerBundle\Entity\PlayerRegistration $registeredPlayer)
    {
        $this->registeredPlayers->removeElement($registeredPlayer);
    }

    /**
     * Get registeredPlayers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRegisteredPlayers()
    {
        return $this->registeredPlayers;
    }

    /**
     * Get registeredPlayers
     *
     * @return \ArrayObject
     */
    public function getRegisteredPlayersAsPlayerInstances()
    {
        $players = new \ArrayObject();

        foreach ($this->getRegisteredPlayers() as $registeredPlayer) {
            $players->append($registeredPlayer->getPlayer());
        }

        return $players;
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
