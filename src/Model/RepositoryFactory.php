<?php

namespace Model;

use Symfony\Component\Yaml\Yaml;

class RepositoryFactory
{
    /**
     * @param $name
     * @param string $driver
     * @param string $type
     * @return BaseRepository
     */
    public function getInstance($name, $driver = 'mysql', $type = 'SQL')
    {
        $config = Yaml::parse(file_get_contents('../config.yml'));
        $className = 'Infrastructure\\Persistence\\' . $type . '\\' . ucfirst($name) . 'Repository';

        switch (strtoupper($type)) {
            case 'SQL':
                $host = $config['databases'][$driver]['host'];
                $dbname = $config['databases'][$driver]['dbname'];
                $user = $config['databases'][$driver]['user'];
                $password = $config['databases'][$driver]['password'];

                $pdo = new \PDO("$driver:host=$host;dbname=$dbname", $user, $password);
                $repository = new $className($pdo);
                break;
            default:
                $repository = new $className();
                break;
        }

        return $repository;
    }
}
