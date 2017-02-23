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

        if (!preg_match("/^\d{9}$/", $this->nif)) {
            $errors['wrong_nif'] = 'NIF must have nine numeric digits';
        }

        if (!preg_match("/^\d{4}-\d{3}$/", $this->postcode)) {
            $errors['wrong_postcode'] = 'Postcode must be typed correctly';
        }

        //As I don't have knowledge about all Portuguese patterns I had to google a regex and I think this covers almost all cases.
        $pattern = '/^(?:9 [1-36] [0-9]| 2 [12] [0-9]| 2 [35] [1-689]| 2 4 [1-59]| 2 6 [1-35689]| 2 7 [1-9]| 2 8 [1-69]| 2 9 [1256])[0-9]{6}$/x';
        $phone = preg_replace('/[^\d]/x', "", $this->phone);

        if ($this->country == 'PT' && !preg_match($pattern, $phone)) {
            $errors['wrong_phone'] = 'Phone number must be valid';
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
            'phone' => preg_replace('/[^\d\+]/x', "", $this->phone),
        ];
    }
}
