<?php

namespace Model;

class RegistrationEntity implements GenericEntity
{
    private $id;
    private $name;
    private $lastname;
    private $email;
    private $emailconf;
    private $password;
    private $passwordconf;
    private $street;
    private $postcode;
    private $city;
    private $country;
    private $nif;
    private $phone;

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{"set" . ucfirst($key)}($value);
                }
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param mixed $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * @param mixed $nif
     */
    public function setNif($nif)
    {
        $this->nif = $nif;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmailconf()
    {
        return $this->emailconf;
    }

    /**
     * @param mixed $emailconf
     */
    public function setEmailconf($emailconf)
    {
        $this->emailconf = $emailconf;
    }

    /**
     * @return mixed
     */
    public function getPasswordconf()
    {
        return $this->passwordconf;
    }

    /**
     * @param mixed $passwordconf
     */
    public function setPasswordconf($passwordconf)
    {
        $this->passwordconf = $passwordconf;
    }

    /**
     * @return array
     */
    public function validate()
    {
        $errors = [];

        if (!$this->getEmail()) {
            $errors['blank_email'] = 'Email is required';
        }

        if ($this->getEmail() != $this->getEmailconf()) {
            $errors['non_confirmed_email'] = 'Email must be confirmed correctly';
        }

        if (!$this->getPassword()) {
            $errors['blank_password'] = 'Password is required';
        }

        if ($this->getPassword() != $this->getPasswordconf()) {
            $errors['non_confirmed_pass'] = 'Password must be confirmed correctly';
        }

        if (!$this->getName()) {
            $errors['blank_name'] = 'Name is required';
        }

        if (!$this->getLastname()) {
            $errors['blank_lastname'] = 'Last name is required';
        }

        return $errors;
    }
}
