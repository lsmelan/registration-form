<?php

namespace Infrastructure\Persistence\SQL;

use Model\BaseRepository;
use Model\GenericEntity;

class RegistrationsRepository extends BaseRepository
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function save(GenericEntity $entity)
    {
        $errors = $entity->validate();

        if (empty($errors)) {
            $params = [
                $entity->getName(),
                $entity->getLastname(),
                $entity->getEmail(),
                $entity->getPassword(),
                $entity->getStreet(),
                $entity->getPostcode(),
                $entity->getCity(),
                $entity->getCountry(),
                $entity->getNif(),
                $entity->getPhone(),
            ];

            $sql = "INSERT INTO registrations
                    (name, last_name, email, password, street, postcode, city, country, nif, phone)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
        } else {
            throw new \InvalidArgumentException;
        }
    }
}
