<?php

namespace FootballManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class PlayerCompetitionController extends RestController
{
    public function getCompetitionsByPlayerAction(Request $request)
    {
        $competitions = $this->getHandler('player')
                             ->getCompetitionsInWhichPlayerIsRegistered($request->get('player'));

        $response = $this->handleView($this->view($competitions, (!empty($competitions)) ? 302 : 204));

        return $this->cacheValidationUsingETag($response, $request);
    }

    public function getPlayersByCompetitionAction(Request $request)
    {
        $players = $this->getHandler('competition')->getAllPlayersOfCompetition($request->get('competition'));

        $response = $this->handleView($this->view($players, (!empty($players)) ? 302 : 204));

        return $this->cacheValidationUsingETag($response, $request);
    }
}
