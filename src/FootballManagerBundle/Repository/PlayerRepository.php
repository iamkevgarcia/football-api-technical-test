<?php

namespace FootballManagerBundle\Repository;

use FootballManagerBundle\Entity\Player;

/**
 * PlayerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlayerRepository extends \Doctrine\ORM\EntityRepository
{
    public function getCompetitionsByPlayer(Player $player)
    {
        $competitions = [];

        foreach ($player->getPlayerRegistrations() as $playerRegistration) {
            $competitions[] = $playerRegistration->getCompetition();
        }

        return $competitions;
    }

    public function save(Player $player, $doFlush = false)
    {
        $this->getEntityManager()->persist($player);
        if ($doFlush) {
            $this->getEntityManager()->flush();
        }
    }

    public function delete(Player $player, $doFlush = false)
    {
        $this->getEntityManager()->remove($player);
        if ($doFlush) {
            $this->getEntityManager()->flush();
        }
    }
}
