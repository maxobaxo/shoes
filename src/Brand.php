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
    }
?>
