<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Store.php';

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function testGetName()
        {
            // Arrange
            $name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($name, $city);

            // Act
            $result = $test_store->getName();

            // Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            // Arrange
            $name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($name, $city);

            $new_name = 'Payless Express';

            // Act
            $test_store->setName($new_name);
            $result = $test_store->getName();

            // Assert
            $this->assertEquals($new_name, $result);
        }

        function testGetCity()
        {
            // Arrange
            $name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($name, $city);

            // Act
            $result = $test_store->getCity();

            // Assert
            $this->assertEquals($city, $result);
        }

        function testSetCity()
        {
            // Arrange
            $name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($name, $city);

            $new_city = 'Flagstaff';
            // Act
            $test_store->setCity($new_city);
            $result = $test_store->getCity();
            // Assert
            $this->assertEquals($new_city, $result);
        }

        function testGetId()
        {
            // Arrange
            $name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($name, $city);
            $test_store->save();

            // Act
            $result = $test_store->getId();

            // Assert
            $this->assertTrue(is_numeric($result));
        }

        function testSave()
        {
            // Arrange
            $name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($name, $city);

            // Act
            $executed = $test_store->save();

            // Assert
            $this->assertTrue($executed, 'This store has not been saved to the database');
        }

        function testFind()
        {
            // Arrange
            $name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($name, $city);
            $test_store->save();

            $name2 = 'Nordstrom';
            $city2 = 'Flagstaff';
            $test_store2 = new Store($name2, $city2);
            $test_store2->save();

            // Act
            $result = Store::find($test_store2->getId());

            // Assert
            $this->assertEquals($test_store2, $result);
        }

        function testGetAll()
        {
            // Arrange
            $name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($name, $city);
            $test_store->save();

            $name2 = 'Nordstrom';
            $city2 = 'Flagstaff';
            $test_store2 = new Store($name2, $city2);
            $test_store2->save();

            // Act
            $result = Store::getAll();

            // Assert
            $this->assertEquals([$test_store2, $test_store], $result);
        }

        function testDeleteAll()
        {
            // Arrange
            $name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($name, $city);
            $test_store->save();

            $name2 = 'Nordstrom';
            $city2 = 'Flagstaff';
            $test_store2 = new Store($name2, $city2);
            $test_store2->save();

            // Act
            Store::deleteAll();
            $result = Store::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

        function testUpdateName()
        {
            // Arrange
            $name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($name, $city);
            $test_store->save();

            $new_name = 'Expensive Shoes';

            // Act
            $test_store->updateName($new_name);

            // Assert
            $this->assertEquals($new_name, $test_store->getName());
        }

        function testUpdateCity()
        {
            // Arrange
            $name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($name, $city);
            $test_store->save();

            $new_city = 'Lake Havasu City';

            // Act
            $test_store->updateCity($new_city);

            // Assert
            $this->assertEquals($new_city, $test_store->getCity());
        }

        function testDelete()
        {
            // Arrange
            $name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($name, $city);
            $test_store->save();

            $name2 = 'Nordstrom';
            $city2 = 'Flagstaff';
            $test_store2 = new Store($name2, $city2);
            $test_store2->save();

            // Act
            $test_store->delete();
            $result = Store::getAll();

            // Assert
            $this->assertEquals([$test_store2], $result);
        }

        function testAddBrand()
        {
            // Arrange
            $name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($name, $city);
            $test_store->save();

            $brand_name = 'Adidas';
            $price_pt = 'low';
            $test_brand = new Brand($brand_name, $price_pt);
            $test_brand->save();

            // Act
            $test_store->addBrand($test_brand);

            // Assert
            $this->assertEquals([$test_brand], $test_store->getBrands());
        }

        function testGetBrands()
        {
            // Arrange
            $name = 'Payless Shoes';
            $city = 'Tuscon';
            $test_store = new Store($name, $city);
            $test_store->save();

            $brand_name = 'Adidas';
            $price_pt = 'low';
            $test_brand = new Brand($brand_name, $price_pt);
            $test_brand->save();

            $name2 = 'Nike';
            $price_pt2 = 'high';
            $test_brand2 = new Brand($name2, $price_pt2);
            $test_brand2->save();

            // Act
            $test_store->addBrand($test_brand);
            $test_store->addBrand($test_brand2);

            // Assert
            $this->assertEquals([$test_brand, $test_brand2], $test_store->getBrands());
        }

    }
?>
