<?php

/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::scope('/api', function (RouteBuilder $routes) {
    $routes->resources('Members', function (RouteBuilder $routes) {
        $routes->resources('Devices');
        $routes->resources('Earnings');
        $routes->resources('Workouts', function (RouteBuilder $routes) {
            $routes->resources('Logs');
        });
        $routes->connect('/matchs', ['controller' => 'Workouts', 'action' => 'indexMatchByMember', '_method' => 'GET']);
        $routes->connect('/performance', ['controller' => 'Members', 'action' => 'getPerformance', '_method' => 'GET']);
    });
    $routes->connect('/members/register', ['controller' => 'Members', 'action' => 'add', '_method' => 'POST']);
    $routes->connect('/members/login', ['controller' => 'Members', 'action' => 'token', '_method' => 'POST']);

    $routes->resources('Contests', function (RouteBuilder $routes) {
        $routes->connect('/matchs', ['controller' => 'Workouts', 'action' => 'indexMatchByContest', '_method' => 'GET']);
        $routes->connect('/score', ['controller' => 'Contests', 'action' => 'getScoreByContest', '_method' => 'GET']);
    });
    $routes->resources('Stickers');

    $routes->connect('/registerdevice/:member_id/:device_serial/:device_description', ['controller' => 'DirtyApis', 'action' => 'registerdevice', '_method' => 'GET'], ['pass' => ['member_id', 'device_serial', 'device_description']]);
    $routes->connect('/workoutparameters/:device_id/:workout_id', ['controller' => 'DirtyApis', 'action' => 'workoutparameters', '_method' => 'GET'], ['pass' => ['device_id', 'workout_id']]);
    $routes->connect('/getsummary/:device_id', ['controller' => 'DirtyApis', 'action' => 'getsummary', '_method' => 'GET'], ['pass' => ['device_id']]);
    $routes->connect('/addlog/:device_id/:match_id/:member_id/points/:points', ['controller' => 'DirtyApis', 'action' => 'addlog', '_method' => 'GET'], ['pass' => ['device_id', 'match_id', 'member_id', 'points']]);
});

Router::connect('/oauth/facebook', ['controller' => 'Members', 'action' => 'login']);

Router::scope('/', function (RouteBuilder $routes) {
    $routes->connect('*', ['controller' => 'Angular', 'action' => 'index']);
});


/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
