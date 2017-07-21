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

            // Arrange
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

            // Arrange
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

            // Arrange
            $name2 = 'Nike';
            $price_pt2 = 'high';
            $test_brand2 = new Brand($name2, $price_pt2);
            $test_brand2->save();

            // Act
            $result = Brand::find($test_brand2->getId());

            // Assert
            $this->assertEquals($test_brand2, $result);
        }
    }
?>
