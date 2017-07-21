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

        }

        function save()
        {

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
