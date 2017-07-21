<?php
    class Store
    {
        private $name;
        private $city;
        private $id;

        function __construct($name, $city, $id = null)
        {
            $this->name = ucfirst(strtolower($name));
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

        static function find($search_id)
        {
            $found_store = null;
            $returned_stores = $GLOBALS['DB']->prepare("SELECT * FROM stores WHERE id = :id;");
            $returned_stores->bindPARAM(":id", $search_id, PDO::PARAM_STR);
            $returned_stores->execute();

            foreach($returned_stores as $store) {
                $name = $store['name'];
                $city = $store['city'];
                $id = $store['id'];
                if ($id == $search_id) {
                    $found_store = new Store($name, $city, $id);
                }
            }
            return $found_store;
        }

        static function getAll()
        {
            $stores = array();
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores ORDER BY name ASC;");
            foreach($returned_stores as $store) {
                $name = $store['name'];
                $city = $store['city'];
                $id = $store['id'];
                $new_store = new Store($name, $city, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM stores;");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        function updateName($new_name)
        {
            $executed = $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
            if ($executed) {
                $this->setName($new_name);
                return true;
            } else {
                return false;
            }
        }

        function updateCity($new_city)
        {
            $executed = $GLOBALS['DB']->exec("UPDATE stores SET city = '{$new_city}' WHERE id = {$this->getId()};");
            if ($executed) {
                $this->setCity($new_city);
                return true;
            } else {
                return false;
            }
        }

        function delete()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        function addBrand($brand)
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");
            if ($executed) {
                return true;
            } else {
                return false;
            }

        }

        function getBrands()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores
            JOIN stores_brands ON (stores_brands.store_id = stores.id)
            JOIN brands ON (brands.id = stores_brands.brand_id)
            WHERE stores.id = {$this->getId()};");

            $brands = array();
            foreach ($returned_brands as $brand) {
                $name = $brand['name'];
                $price_pt = $brand['price_pt'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $price_pt, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }
    }
?>
