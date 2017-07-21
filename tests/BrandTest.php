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
        // protected function tearDown()
        // {
        //     Store::deleteAll();
        //     Brand::deleteAll()
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

    }
?>
