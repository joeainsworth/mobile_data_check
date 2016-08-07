<?php

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/upload', 'UploadController:getUpload')->setName('upload');
$app->post('/upload', 'UploadController:postUpload');

$app->get('/subscriber', 'SubscriberController:index')->setName('subscriber');
$app->post('/subscriber', 'SubscriberController:postSubscriber');
$app->get('/subscriber/{id}', 'SubscriberController:getSubscriber');


$app->get('/results', 'ResultsController:index')->setName('results');