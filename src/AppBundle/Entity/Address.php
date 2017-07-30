<?php

namespace AppBundle\Entity;

/**
 * Class Address
 *
 * @author Bianca VADEAN bianca.vadean@zitec.com
 * @copyright Copyright (c) Zitec COM
 */
class Address
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $street;

    /**
     * @var string
     */
    protected $number;

    /**
     * @var string
     */
    protected $details;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $county;

    /**
     * @var User
     */
    protected $user;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string $street
     * @return Address
     */
    public function setStreet(?string $street): Address
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return Address
     */
    public function setNumber(?string $number): Address
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getDetails(): ?string
    {
        return $this->details;
    }

    /**
     * @param string $details
     * @return Address
     */
    public function setDetails(?string $details): Address
    {
        $this->details = $details;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity(?string $city): Address
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Address
     */
    public function setCountry(?string $country): Address
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getCounty(): ?string
    {
        return $this->county;
    }

    /**
     * @param string $county
     * @return Address
     */
    public function setCounty(?string $county): Address
    {
        $this->county = $county;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Address
     */
    public function setUser(User $user): Address
    {
        $this->user = $user;

        return $this;
    }
}
