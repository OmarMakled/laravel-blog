<?php

/*
 * This file is part of Emergency Riyadh Project 2016.
 *
 * @author Omar Makled <omar.makled@ssd.sa>
 */

namespace App\Services\Presenters\Foundation;

abstract class Presenter
{
    /**
     * @var mixed
     */
    protected $entity;

    /**
     * Create new instance of an Presenter.
     *
     * @param $entity
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    /**
     * Present created_at filed
     *
     * @return string
     */
    public function created_at()
    {
        return $this->entity->created_at->format('j, M Y g:i A');
    }

    /**
     * Present user name filed
     *
     * @return string
     */
    public function userName()
    {
        return '@'.$this->entity->user->name;
    }

    /**
     * Allow for property-style retrieval
     *
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return $this->{$property}();
        }

        return $this->entity->{$property};
    }
}
