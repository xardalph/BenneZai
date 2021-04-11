<?php


class CategoryManager
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

    public function getAllCategory()
    {
        $query = $this->_db->prepare('SELECT name FROM category');
        $query->execute();

        while ($donnees = $query->fetch(PDO::FETCH_ASSOC))
        {
            $categoryList[] = new Category($donnees);
        }
        return $categoryList ;
    }


}