<?php

namespace FootballManagerBundle\Handler;

class CompetitionHandler extends BaseHandler
{
    public function getAllPlayersOfCompetition(int $competitionId)
    {
        $competitionObj = $this->getOr404('id', $competitionId);

        return $this->_repository->getPlayersByCompetition($competitionObj);
    }

    public function getTeamsWithRegisteredPlayersInACompetition(int $competitionId)
    {
        $competitionObj = $this->getOr404('id', $competitionId);

        return $competitionObj->getTeamsWithRegisteredPlayers();
    }
}