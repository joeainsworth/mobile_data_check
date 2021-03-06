<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

// Instantiate Slim with some settings
$app = new \Slim\App([
	'settings' => [
		'displayErrorDetails' => true,
		'addContentLengthHeader' => false,
		'db' => [
			'driver' => 'mysql',
			'host' => 'localhost',
			'database' => 'firetext_challenge',
			'username' => 'root',
			'password' => 'm1lkw00d',
			'charset' => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix' => ''
		]
	]
]);

// Set-up container so it can be bound too
$container = $app->getContainer();

// Add CSRF
$container['csrf'] = function ($container) {
    return new \Slim\Csrf\Guard;
};
$app->add(new \App\Middleware\CsrfViewMiddleware($container));
// $app->add($container->csrf);

// Add flash support
$container['flash'] = function ($container) {
    return new \Slim\Flash\Messages;
};

// Set-up Eloquent for interacting with the database
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function($container) use ($capsule) {
	return $capsule;
};

$container['view'] = function ($container) {
	$view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
		'cache' => false
	]);

	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
	));

	$view->getEnvironment()->addGlobal('flash', $container->flash);

	return $view;
};

$container['HomeController'] = function ($container) {
	return new \App\Controllers\HomeController($container);
};

$container['ContactListController'] = function ($container) {
	return new \App\Controllers\ContactListController($container);
};

$container['contacts'] = function ($container) {
	return new \App\Contacts\Contacts;
};

$container['SubscriberController'] = function ($container) {
	return new \App\Controllers\SubscriberController($container);
};

$container['subscribers'] = function ($container) {
	return new \App\Subscribers\Subscribers;
};

$container['ResultController'] = function ($container) {
	return new \App\Controllers\ResultController($container);
};

$container['sms'] = function ($container) {
	return new \App\SMS\SMS;
};

require __DIR__ . '/../app/routes.php';

