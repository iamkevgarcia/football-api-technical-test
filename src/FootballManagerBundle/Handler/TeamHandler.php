<?php

namespace FootballManagerBundle\Handler;

class TeamHandler extends BaseHandler
{
    public function getTeamsWithRegisteredPlayersInACompetition(int $competitionId)
    {
        $competitionObj = $this->getOr404('id', $competitionId);

        return $this->_repository->getTeamsWithRegisteredPlayersInACompetition($competitionObj);
    }
}