<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 26/04/17
 * Time: 22:16
 */

namespace FootballManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerRegistration
 *
 * @ORM\Table(name="player_registration")
 * @ORM\Entity(repositoryClass="FootballManagerBundle\Repository\PlayerRegistrationRepository")
 */
class PlayerRegistration
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
     * @var TeamRegistration
     *
     * @ORM\ManyToOne(targetEntity="TeamRegistration", inversedBy="registeredPlayers")
     * @ORM\JoinColumn(name="team_registration_id", referencedColumnName="id")
     */
    private $teamRegistration;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="competitionsInWhichIsRegistered")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set teamRegistration
     *
     * @param \FootballManagerBundle\Entity\TeamRegistration $teamRegistration
     *
     * @return PlayerRegistration
     */
    public function setTeamRegistration(\FootballManagerBundle\Entity\TeamRegistration $teamRegistration = null)
    {
        $this->teamRegistration = $teamRegistration;

        return $this;
    }

    /**
     * Get teamRegistration
     *
     * @return \FootballManagerBundle\Entity\TeamRegistration
     */
    public function getTeamRegistration()
    {
        return $this->teamRegistration;
    }

    /**
     * Set player
     *
     * @param \FootballManagerBundle\Entity\Player $player
     *
     * @return PlayerRegistration
     */
    public function setPlayer(\FootballManagerBundle\Entity\Player $player = null)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \FootballManagerBundle\Entity\Player
     */
    public function getPlayer()
    {
        return $this->player;
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

    public function getCompetition()
    {
        return $this->teamRegistration->getCompetition();
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
