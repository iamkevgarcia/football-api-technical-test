<?php

namespace FootballManagerBundle\Form\Handler;

use FootballManagerBundle\Exception\InvalidFormException;
use Symfony\Component\Form\FormFactoryInterface;

class FormHandler
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * FormHandler constructor.
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @param $object
     * @param array $parameters
     * @param $method
     * @param $formType
     * @param array $options
     * @return mixed
     */
    public function handle($object, array $parameters, $method, $formType, array $options = [])
    {
        $options = array_replace_recursive([
            'method'            => $method,
            'csrf_protection'   => false,
        ], $options);

        $form = $this->formFactory->create($formType, $object, $options);

        $form->submit($parameters, 'PATCH' !== $method);

        if (!$form->isValid()) {
            throw new InvalidFormException($form);
        }

        return $form->getData();
    }
}