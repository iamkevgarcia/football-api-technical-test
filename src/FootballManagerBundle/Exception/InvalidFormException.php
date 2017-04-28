<?php

namespace FootballManagerBundle\Exception;

class InvalidFormException extends \RuntimeException
{
    private $form;

    public function __construct($form, $message = null)
    {
        parent::__construct( $message );
        $this->form = $form;
    }

    public function getForm()
    {
        return $this->form;
    }
}