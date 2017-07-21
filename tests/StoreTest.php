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

        }

        function testGetCity()
        {

        }

        function testSetCity()
        {

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
