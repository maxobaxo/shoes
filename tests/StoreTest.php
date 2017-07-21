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
