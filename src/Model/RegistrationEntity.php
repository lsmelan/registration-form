<?php

namespace Model;

class RegistrationEntity implements GenericEntity
{
    private $id;
    private $name;
    private $last_name;
    private $email;
    private $email_conf;
    private $password;
    private $password_conf;
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
                    $this->{$key} = $value;
                }
            }
        }
    }

    /**
     * @return array
     */
    public function validate()
    {
        $errors = [];

        if (empty($this->email)) {
            $errors['blank_email'] = 'Email is required';
        }

        if ($this->email != $this->email_conf) {
            $errors['non_confirmed_email'] = 'Email must be confirmed correctly';
        }

        if (empty($this->password)) {
            $errors['blank_password'] = 'Password is required';
        }

        if ($this->password != $this->password_conf) {
            $errors['non_confirmed_pass'] = 'Password must be confirmed correctly';
        }

        if (empty($this->name)) {
            $errors['blank_name'] = 'Name is required';
        }

        if (empty($this->last_name)) {
            $errors['blank_lastname'] = 'Last name is required';
        }

        return $errors;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => md5($this->password),
            'street' => $this->street,
            'postcode' => $this->postcode,
            'city' => $this->city,
            'country' => $this->country,
            'nif' => $this->nif,
            'phone' => $this->phone,
        ];
    }
}
