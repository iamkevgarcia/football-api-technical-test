<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 27/04/17
 * Time: 0:49
 */

namespace FootballManagerBundle\Handler;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use FootballManagerBundle\Form\Handler\FormHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BaseHandler {

    /**
     * @var EntityManager
     */
    protected $_em;

    /**
     * @var string
     */
    protected $_entityClass;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $_repository;

    /**
     * @var FormHandler
     */
    protected $_formHandler;

    /**
     * BaseHandler constructor.
     * @param EntityManager $entityManager
     * @param $entityClass
     * @param FormHandler $formHandler
     */
    public function __construct(EntityManager $entityManager, $entityClass, FormHandler $formHandler)
    {
        $this->_em = $entityManager;
        $this->_entityClass = $entityClass;
        $this->_repository = $this->_em->getRepository($this->_entityClass);
        $this->_formHandler = $formHandler;
    }

    /**
     * @param string $property
     * @param string $value
     * @throws NotFoundHttpException
     * @return Entity
     */
    public function getOr404(string $property, string $value)
    {
        if (!$result = $this->getOneBy($property, $value)) {
            throw new NotFoundHttpException($this->_entityClass . ' with property ' . $property . ' = ' . $value .
                ' was not found.');
        }

        return $result;
    }

    /**
     * Get one by property.
     *
     * @param string $property
     * @param string $value
     * @return Entity
     */
    protected function getOneBy(string $property, string $value)
    {
        $find = 'findOneBy' . ucfirst($property);
        return $this->_repository->$find($value);
    }

    /**
     * @param string $property
     * @param string $value
     * @return ArrayCollection
     */
    public function getAllBy(string $property, string $value)
    {
        $find = 'findBy' . ucfirst($property);
        return $this->_repository->$find($value);
    }

    /**
     * @return Object
     */
    protected function getEntityInstance()
    {
        return new $this->_entityClass();
    }
}