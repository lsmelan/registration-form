<?php

namespace Model;

class RepositoryFactory
{
    public function getInstance($name, $driver = 'mysql', $type = 'SQL')
    {
        $className = 'Infrastructure\\Persistence\\' . $type . '\\' . ucfirst($name) . 'Repository';

        switch (strtoupper($type)) {
            case 'SQL':
                $pdo = new \PDO($driver . ':host=localhost;dbname=challenge', 'root', 'root');
                $repository = new $className($pdo);
                break;
            default:
                $repository = new $className();
                break;
        }

        return $repository;
    }
}
