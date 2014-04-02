<?php
session_start();

// Load up composer autoload, and instantiate the application.
require 'vendor/autoload.php';

$app = new \Slim\Slim;
$app->config('baseRoute', '/');

// Register a singleton of the Mustache engine, and tell it to cache
$app->container->singleton('twig', function () {
	$loader = new Twig_Loader_Filesystem('pages');
	return new Twig_Environment($loader, array(
		'cache' => 'storage',
	));
});

// Helper function to render templates
function renderTemplate($name, $data = array()) {
	global $app;

	if (file_exists('config.php')) {
		$data += (require 'config.php');
	}

	$data += array(
		'resourceUri' => $app->config('baseRoute') . $app->request->getResourceUri() ?: 'index',
		'baseUri' => $app->config('baseRoute'),
		'request' => $app->request
	);

	return $app->twig->loadTemplate($name)->render($data);
}
// Loads a page by the given name/path
function loadPage($path) {
	global $app;

	// Set up the base path
	$f = 'pages/' . $path;
	
	if (file_exists($f . '.html')) {
		// If there's an HTML file, render the mustache template
		return renderTemplate($path . '.html');
	} elseif (file_exists($f . '.php')) {
		// If there's a PHP file, return it
		return (require $f . '.php');
	} elseif ($path != '404') {
		// Otherwise, go get the 404 page
		return loadPage('404');
	} else {
		// But if the user doesn't have a 404 page made, return a plain 404
		$app->halt(404);
	}
}

// Index page
$app->get('/', function () use ($app) {
	echo loadPage('index');
});


// Route to everything else
$app->get('/.*?', function () use ($app) {
	// Get the current request path
	$path = $app->request->getResourceUri();

	// Make sure the user isn't trying to escape and do nasty things
	if (!preg_match('/^[A-z\/\-\_]+$/', $path)) {
		echo loadPage('404');
	}

	// Send the page off to get loaded
	echo loadPage($path);
});
$app->run();