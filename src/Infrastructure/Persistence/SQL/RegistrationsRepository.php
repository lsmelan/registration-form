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

        $toArray = $entity->toArray();

        if ($this->findByEmail($toArray['email'])) {
            $errors['existent_email'] = 'You already registered';
        }

        if (empty($errors)) {
            $sql = "INSERT INTO registrations
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute(array_values($toArray));
        }

        return $errors;
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * from registrations WHERE email = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchObject('Model\RegistrationEntity');
    }
}
