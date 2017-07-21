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

    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get('/stores', function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post('/stores', function() use ($app) {
        $new_store = new Store($_POST['name'], $_POST['city']);
        $new_store->save();

        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

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

    $app->delete('delete_stores', function() use($app) {
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->get('/stores/{id}', function($id) use ($app) {
        $store = Store::find($id);

        return $app['twig']->render('store.html.twig', array('store' => $store));
    });

    return $app;
?>
