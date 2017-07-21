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

        function testSave()
        {

        }

        function testFind()
        {

        }

        function testGetId()
        {

        }

        function testGetAll()
        {

        }

        function testDeleteAll()
        {

        }

        function testUpdate()
        {

        }

        function testDelete()
        {

        }
    }
?>
