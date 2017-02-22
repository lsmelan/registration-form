<?php

namespace Model;

abstract class BaseRepository
{
    abstract public function save(GenericEntity $entity);

    abstract function findByEmail($email);
}
