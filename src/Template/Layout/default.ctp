<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

?>

<!DOCTYPE html>
<html ng-app="app" ng-strict-di>
    <head>
    <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Deepwater Project</title>
        <base href="/">

    <?= $this->Html->meta('icon') ?>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    </head>
    <body>
    <?= $this->fetch('content') ?>

    <?= $this->Html->script('/inline.bundle') ?>
    <?= $this->Html->script('/polyfills.bundle') ?>
    <?= $this->Html->script('/styles.bundle') ?>
    <?= $this->Html->script('/vendor.bundle') ?>
    <?= $this->Html->script('/main.bundle') ?>
    <script type="text/javascript" src="https://connect.facebook.net/en_US/sdk.js"></script>
    </body>
</html>
