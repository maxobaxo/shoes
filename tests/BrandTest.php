<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Store.php';
    require_once 'src/Brand.php';

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        // function testCapitalizeName()
        // {
        //     $name = 'the aDidas of the wOrld';
        //     $price_pt = 'low';
        //     $test_brand = new Brand($name, $price_pt);
        //     $test_brand->save();
        //
        //     // Act
        //     $result = $test_brand->capitalizeName($name);
        //
        //     // Assert
        //     $this->assertEquals('The Adidas of the World', $result);
        // }

        function testGetName()
        {
            // Arrange
            $name = 'Adidas';
            $price_pt = 'low';
            $test_brand = new Brand($name, $price_pt);

            // Act
            $result = $test_brand->getName();

            // Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            // Arrange
            $name = 'Adidas';
            $price_pt = 'low';
            $test_brand = new Brand($name, $price_pt);

            $new_name = 'Nike';

            // Act
            $test_brand->setName($new_name);
            $result = $test_brand->getName();

            // Assert
            $this->assertEquals($new_name, $result);
        }

        function testGetPricePt()
        {
            // Arrange
            $name = 'Adidas';
            $price_pt = 'low';
            $test_brand = new Brand($name, $price_pt);

            // Act
            $result = $test_brand->getPricePt();

            // Assert
            $this->assertEquals($price_pt, $result);
        }

        function testSetPricePt()
        {
            // Arrange
            $name = 'Adidas';
            $price_pt = 'low';
            $test_brand = new Brand($name, $price_pt);

            $new_price_pt = 'medium';

            // Act
            $test_brand->setPricePt($new_price_pt);
            $result = $test_brand->getPricePt();

            // Assert
            $this->assertEquals($new_price_pt, $result);
        }

        function testGetId()
        {
            // Arrange
            $name = 'Adidas';
            $price_pt = 'low';
            $test_brand = new Brand($name, $price_pt);
            $test_brand->save();

            // Act
            $result = $test_brand->getId();

            // Assert
            $this->assertTrue(is_numeric($result));
        }

        function testSave()
        {
            // Arrange
            $name = 'Adidas';
            $price_pt = 'low';
            $test_brand = new Brand($name, $price_pt);

            // Act
            $executed = $test_brand->save();

            // Assert
            $this->assertTrue($executed, 'The brand was not saved to the database');
        }

        function testGetAll()
        {
            // Arrange
            $name = 'Adidas';
            $price_pt = 'medium';
            $test_brand = new Brand($name, $price_pt);
            $test_brand->save();

            $name2 = 'Nike';
            $price_pt2 = 'high';
            $test_brand2 = new Brand($name2, $price_pt2);
            $test_brand2->save();

            // Act
            $result = Brand::getAll();

            // Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);

        }

        function testDeleteAll()
        {
            // Arrange
            $name = 'Adidas';
            $price_pt = 'medium';
            $test_brand = new Brand($name, $price_pt);
            $test_brand->save();

            $name2 = 'Nike';
            $price_pt2 = 'high';
            $test_brand2 = new Brand($name2, $price_pt2);
            $test_brand2->save();

            // Act
            Brand::deleteAll();
            $result = Brand::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            // Arrange
            $name = 'Adidas';
            $price_pt = 'medium';
            $test_brand = new Brand($name, $price_pt);
            $test_brand->save();

            $name2 = 'Nike';
            $price_pt2 = 'high';
            $test_brand2 = new Brand($name2, $price_pt2);
            $test_brand2->save();

            // Act
            $result = Brand::find($test_brand2->getId());

            // Assert
            $this->assertEquals($test_brand2, $result);
        }

        function testUpdateName()
        {
            // Arrange
            $name = 'Adidas';
            $price_pt = 'medium';
            $test_brand = new Brand($name, $price_pt);
            $test_brand->save();

            $new_name = 'Nike';

            // Act
            $test_brand->updateName($new_name);

            // Assert
            $this->assertEquals($new_name, $test_brand->getName());
        }

        function testUpdatePricePt()
        {
            // Arrange
            $name = 'Adidas';
            $price_pt = 'medium';
            $test_brand = new Brand($name, $price_pt);
            $test_brand->save();

            $new_price_pt = 'high';

            // Act
            $test_brand->updatePricePt($new_price_pt);

            // Assert
            $this->assertEquals($new_price_pt, $test_brand->getPricePt());
        }

        function testDelete()
        {
            // Arrange
            $name = 'Adidas';
            $price_pt = 'medium';
            $test_brand = new Brand($name, $price_pt);
            $test_brand->save();

            $name2 = 'Nike';
            $price_pt2 = 'high';
            $test_brand2 = new Brand($name2, $price_pt2);
            $test_brand2->save();

            // Act
            $test_brand->delete();

            // Assert
            $this->assertEquals([$test_brand2], Brand::getAll());
        }

        function testAddStore()
        {
            // Arrange
            $store_name = 'Adidas';
            $price_pt = 'medium';
            $test_brand = new Brand($store_name, $price_pt);
            $test_brand->save();

            $store_name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($store_name, $city);
            $test_store->save();

            // Act
            $test_brand->addStore($test_store);

            // Assert
            $this->assertEquals([$test_store], $test_brand->getStores());
        }

        function testGetStores()
        {
            // Arrange
            $store_name = 'Adidas';
            $price_pt = 'medium';
            $test_brand = new Brand($store_name, $price_pt);
            $test_brand->save();

            $store_name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($store_name, $city);
            $test_store->save();

            $store_name2 = 'Nordstrom';
            $city2 = 'Flagstaff';
            $test_store2 = new Store($store_name2, $city2);
            $test_store2->save();

            // Act
            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);

            // Assert
            $this->assertEquals([$test_store, $test_store2], $test_brand->getStores());
        }
    }
?>
