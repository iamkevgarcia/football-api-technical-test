<?php

namespace FootballManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class PlayerController extends RestController
{
    public function postAction(Request $request)
    {
        return $this->handleView(
            $this->view($this->getHandler('player')->post($request->request->all()), 201)
        );
    }

    public function patchAction(Request $request, $id)
    {
        return $this->handleView(
            $this->view($this->getHandler('player')->patch($id, $request->request->all()), 200)
        );
    }

    public function deleteAction(Request $request)
    {
        return $this->handleView(
            $this->view($this->getHandler('player')->delete($request->get('id')), 204)
        );
    }

    public function searchByFieldAction(Request $request, $field_name, $field_value)
    {
        $coincidences = $this->getHandler('player')->getAllBy($field_name, $field_value);

        $response = $this->handleView(
            $this->view($coincidences, (!empty($coincidences) ? 302 : 204))
        );

        return $this->cacheValidationUsingETag($response, $request);
    }

    public function searchByFieldInSpecifiedTeamAction(Request $request, $team, $field_name, $field_value)
    {
        $coincidences = $this->getHandler('player')->getAllByFieldInSpecifiedTeam($team, $field_name, $field_value);

        $response = $this->handleView($this->view($coincidences, (!empty($coincidences)) ? 302 : 204));

        return $this->cacheValidationUsingETag($response, $request);
    }
}
