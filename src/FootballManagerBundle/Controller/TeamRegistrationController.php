<?php

namespace FootballManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class TeamRegistrationController extends RestController
{
    public function getTeamsWithPlayersInAGivenCompetitionAction(Request $request, int $competition)
    {
        $teams = $this->getHandler('competition')
                      ->getTeamsWithRegisteredPlayersInACompetition($competition);

        $response = $this->handleView($this->view($teams, (!empty($teams)) ? 302 : 204));

        return $this->cacheValidationUsingETag($response, $request);
    }
}
