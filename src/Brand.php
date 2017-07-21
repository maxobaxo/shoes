<?php
    class Brand
    {
        private $name;
        private $price_pt;
        private $id;

        function __construct($name, $price_pt, $id = null)
        {
            $this->name = $name;
            $this->price_pt = $price_pt;
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

        function getPricePt()
        {
            return $this->price_pt;
        }

        function setPricePt($new_price_pt)
        {
            $this->price_pt = $new_price_pt;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO brands (name, price_pt) VALUES ('{$this->getName()}', '{$this->getPricePt()}');");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }

        static function getAll()
        {
            $brands = array();
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            foreach ($returned_brands as $brand) {
                $name = $brand['name'];
                $price_pt = $brand['price_pt'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $price_pt, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM brands;");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        static function find($search_id)
        {

        }

        function updateName()
        {

        }

        function updatePricePt()
        {

        }

        function delete()
        {

        }
    }
?>
