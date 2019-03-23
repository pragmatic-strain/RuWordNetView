<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

/** @var $app Application */

$app['controllers']
    ->value('_locale', 'ru');

$app->get('/', function () use ($app) {
    $locale = $app['session']->get('locale') ?? 'ru';
    return $app->redirect("/$locale");
});
$app->get('/{_locale}', "site.controller:homepageAction");
$app->get('/{_locale}/', "site.controller:homepageAction")->bind('homepage');
$app->get('/{_locale}/search', "site.controller:searchAction")->bind('search');
$app->get('/{_locale}/search/', "site.controller:searchAction");
$app->get('/{_locale}/search/{searchString}', "site.controller:searchAction");
$app->get('/{_locale}/sense/{name}/{meaning}', "site.controller:senseAction")
    ->value('meaning', 0)
    ->bind('sense');
$app->get('/{_locale}/{whatever}', function () use ($app) {
    return $app['twig']->render('Site/404.html.twig', ['_locale' => $app['locale']]);
});
$app->get('/{whatever}', function ($whatever) use ($app) {
    $locale = $app['session']->get('locale') ?? 'ru';
    return $app->redirect("/$locale/$whatever");
});

$app->error(function (\Exception $e, $code) use ($app) {
    $params = []; //['_locale' => $app['locale']];

    switch ($code) {
    case 404:
        return $app['twig']->render('Site/404.html.twig', $params);
    default:
		return $app['debug'] ? null : $app['twig']->render('Site/error.html.twig', $params);
    }
});

