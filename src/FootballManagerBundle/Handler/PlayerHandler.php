<?php

namespace FootballManagerBundle\Handler;

use FootballManagerBundle\Form\Type\PlayerType;

class PlayerHandler extends BaseHandler
{
    /**
     * @param int $playerId
     * @return \ArrayObject
     */
    public function getCompetitionsInWhichPlayerIsRegistered(int $playerId)
    {
        $playerObj = $this->getOr404('id', $playerId);

        return $this->_repository->getCompetitionsByPlayer($playerObj);
    }

    /**
     * @param array $parameters
     * @return mixed
     */
    public function post(array $parameters)
    {
        $entityInstance = $this->getEntityInstance();

        $formData = $this->_formHandler->handle($entityInstance, $parameters, 'POST', PlayerType::class);
        $entityInstance->updateTimestamps();
        $this->_repository->save($entityInstance, true);
        return $formData;
    }

    /**
     * @param int $playerId
     * @param array $parameters
     * @return mixed
     */
    public function patch(int $playerId, array $parameters)
    {
        $playerObj = $this->getOr404('id', $playerId);

        $formData = $this->_formHandler->handle($playerObj, $parameters, 'PATCH', PlayerType::class);
        $playerObj->updateTimestamps();
        $this->_repository->save($playerObj, true);
        return $formData;
    }

    /**
     * @param int $playerId
     * @return array
     */
    public function delete(int $playerId)
    {
        $playerObj = $this->getOr404('id', $playerId);
        $this->_repository->delete($playerObj, true);
        return [];
    }

    public function getAllByFieldInSpecifiedTeam(int $teamId, string $fieldName, string $fieldValue)
    {
        return $this->_repository->findBy([
            'team' => $teamId,
            $fieldName => $fieldValue
        ]);
    }
}