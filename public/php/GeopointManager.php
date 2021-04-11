<?php


class GeopointManager
{
    private $_db;

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }

    /**
     * @param mixed $db
     */
    public function setDb($db): void
    {
        $this->_db = $db;
    }

    /**
     * @param Geopoint $geopoint
     */
    public function add(Geopoint $geopoint): void
    {
        $query = $this->_db->prepare('INSERT INTO geopoint(longitude, latitude, category_name, username ) VALUES(:longitude, :latitude, :category_name, :username)');
        $query->bindValue(':longitude', $geopoint->getLongitude() ) ;
        $query->bindValue(':latitude', $geopoint->getLatitude() ) ;
        $query->bindValue(':category_name', $geopoint->getCategory() ) ;
        $query->bindValue(':username', $geopoint->getUsername() ) ;
        $query->execute();

    }




}