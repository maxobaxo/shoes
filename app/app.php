<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Store.php';
    require_once __DIR__.'/../src/Brand.php';

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array("twig.path" => __DIR__."/../views"));

// HOME
    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

// View current list of stores
    $app->get('/stores', function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

// After adding a new store,  view updated list of stores
    $app->post('/stores', function() use ($app) {
        $new_store = new Store($_POST['name'], $_POST['city']);
        $new_store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

// After updating a store, view the updated list of stores
    $app->patch('/stores/{id}', function($id) use ($app) {
        $store = Store::find($id);
        $new_name = $_POST['new_name'];
        if ($new_name) {
            $store->updateName($new_name);
        }
        $new_city = $_POST['new_city'];
        if ($new_city) {
            $store->updateCity($new_city);
        }
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

// After deleting all the stores, view the empty list of stores
    $app->delete('delete_stores', function() use($app) {
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

// After deleting a single store, view the updated list of stores
    $app->delete('/stores', function() use ($app) {
        $store_id = $_POST['store_id'];
        $store = Store::find($store_id);
        $store->delete();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

// View store-specific info, with options to update/delete said store
    $app->get('/stores/{id}', function($id) use ($app) {
        $store = Store::find($id);

        return $app['twig']->render('store.html.twig', array('store' => $store));
    });

// View current list of brands
    $app->get('/brands', function() use ($app) {
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

// After adding a new brand,  view updated list of brands
    $app->post('/brands', function() use ($app) {
        $new_brand = new Brand($_POST['name'], $_POST['price_pt']);
        $new_brand->save();


        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    $app->get('brands/{id}', function($id) use ($app) {
        $brand = Brand::find($id);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand));
    });

    $app->patch('/brands/{id}', function($id) use ($app) {
        $brand = Brand::find($id);
        $new_name = $_POST['new_name'];
        if ($new_name) {
            $brand->updateName($new_name);
        }
        $new_price_pt = $_POST['price_pt'];
        if ($new_price_pt) {
            $brand->updatePricePt($new_price_pt);
        }

        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

// After deleting all the brands, view the empty list of brands
    $app->delete('delete_brands', function() use($app) {
        Brand::deleteAll();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });


    return $app;
?>
