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

        }

        function setPricePt()
        {

        }

        function getId()
        {

        }
    }
?>
