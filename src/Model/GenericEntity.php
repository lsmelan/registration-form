<?php

namespace Model;

interface GenericEntity
{
    /**
     * @return array
     */
    public function validate();

    /**
     * @return array
     */
    public function toArray();
}
