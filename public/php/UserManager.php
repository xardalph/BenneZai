<?php


class UserManager
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

    public function add(User $perso)
    {
        $query = $this->_db->prepare('INSERT INTO username(username, password, admin ) VALUES(:username,:password,:admin)');
        $query->bindValue(':username', $perso->getUsername() ) ;
        $query->bindValue(':password', $perso->getPassword() ) ;
        $query->bindValue(':admin', '0'  ) ;
        $query->execute();

    }

    public function count()
    {
        $query = $this->_db->prepare('SELECT count(*) FROM user');
        $query->execute();
        $result = $query->fetch();

        return $result[0];

    }

    public function exist($name)
    {
        if (is_numeric($name)) {
            $query = $this->_db->prepare('select count(*) from username where id = :id');
            $query->execute(array(':id' => $name));
            $result = $query->fetch();

            return $result[0];



        } else {
            $query = $this->_db->prepare('select count(*) from username where username = :username');
            $query->execute(array(':username' => $name));
            $result = $query->fetch();
            return $result[0];
        }

    }

    public function getAuthenticatedUser($name, $password)
    {

        $query = $this->_db->prepare('select * from username where username = :username and password = :password');
        $query->execute(array(':username' => $name, ':password' => $password));

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result == false) {
            return false;
        } else {
            return new User($result);
        }


    }

}