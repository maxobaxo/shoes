<?php
    class Store
    {
        private $name;
        private $city;
        private $id;

        function __construct($name, $city, $id = null)
        {
            $this->name = $name;
            $this->city = $city;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getCity()
        {
            return $this->city;
        }

        function setCity($new_city)
        {
            $this->city = $new_city;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO stores (name, city) VALUES ('{$this->getName()}', '{$this->getCity()}');");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }

        static function find()
        {

        }

        static function getAll()
        {

        }

        static function deleteAll()
        {

        }

        function update()
        {

        }

        function delete()
        {

        }
    }
?>
