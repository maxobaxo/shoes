<?php
    class Brand
    {
        private $name;
        private $price_pt;
        private $id;

        function __construct($name, $price_pt, $id = null)
        {
            $this->name = $this->capitalizeName($name);
            $this->price_pt = $price_pt;
            $this->id = $id;
        }

        function capitalizeName($name)
        {
            $lower_ucfirst_name_arr = array();
            $name_words = explode(" ", $name);
            // var_dump($name_words);
            foreach ($name_words as $word) {
                if ($word == $name_words[0]) {
                    $word = ucfirst(strtolower($word));
                    array_push($lower_ucfirst_name_arr, $word);
                } else {
                    if (strtolower($word) == 'a' || strtolower($word) == 'the' || strtolower($word) == 'of' || strtolower($word) == 'and') {
                        $word = strtolower($word);
                        array_push($lower_ucfirst_name_arr, $word);
                    } else {
                        $word = ucfirst(strtolower($word));
                        array_push($lower_ucfirst_name_arr, $word);
                    }
                }
            }
            $name = implode(" ", $lower_ucfirst_name_arr);
            return $name;
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
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands ORDER BY name ASC;");
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
            $executed = $GLOBALS['DB']->exec('DELETE FROM brands;');
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        static function find($search_id)
        {
            $found_brand = null;
            $returned_brands = $GLOBALS['DB']->prepare('SELECT * FROM brands WHERE id = :id;');
            $returned_brands->bindPARAM(':id', $search_id, PDO::PARAM_STR);
            $returned_brands->execute();

            foreach ($returned_brands as $brand) {
                $name = $brand['name'];
                $price_pt = $brand['price_pt'];
                $id = $brand['id'];
                if ($id == $search_id) {
                    $found_brand = new Brand($name, $price_pt, $id);
                }
            }
            return $found_brand;
        }

        function updateName($new_name)
        {
            $executed = $GLOBALS['DB']->exec("UPDATE brands SET name = '{$new_name}' WHERE id = {$this->getId()};");
            if ($executed) {
                $this->setName($new_name);
                return true;
            } else {
                return false;
            }
        }

        function updatePricePt($new_price_pt)
        {
            $executed = $GLOBALS['DB']->exec("UPDATE brands SET price_pt = '{$new_price_pt}' WHERE id = {$this->getId()};");
            if ($executed) {
                $this->setPricePt($new_price_pt);
                return true;
            } else {
                return false;
            }
        }

        function delete()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        function addStore($store)
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        function getStores()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
            JOIN stores_brands ON (stores_brands.brand_id = brands.id)
            JOIN stores ON (stores.id = stores_brands.store_id)
            WHERE brands.id = {$this->getId()};");

            $stores = array();
            foreach ($returned_stores as $store) {
                $name = $store['name'];
                $city = $store['city'];
                $id = $store['id'];
                $new_store = new Store($name, $city, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }
    }
?>
