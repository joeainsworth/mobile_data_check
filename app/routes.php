<?php

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/upload', 'UploadController:getUpload')->setName('upload');
$app->post('/upload', 'UploadController:postUpload');

$app->post('/subscriber/post', 'SubscriberController:postSubscriber');
$app->get('/subscriber/{id}', 'SubscriberController:getSubscriber')->setName('viewSubscriber');


$app->get('/results', 'ResultController:index')->setName('results');
$app->get('/results/{id}', 'ResultController:getResults')->setName('viewResults');
$app->get('/results/download/{id}', 'ResultController:downloadResults')->setName('downloadResults');