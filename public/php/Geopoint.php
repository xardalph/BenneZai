<?php


class Geopoint
{
    private $_longitude;
    private $_latitude;
    private $_category;
    private $_username;

    public function __construct(array $data)
    {

        $this->hydrate($data);

    }

    public function hydrate(array $data)
    {

        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {

                $this->$method($value);
            }
        }

    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->_longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void
    {
        $this->_longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->_latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude): void
    {
        $this->_latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->_category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->_category = $category;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->_username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->_username = $username;
    }





}

