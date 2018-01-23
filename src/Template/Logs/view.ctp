<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Log $log
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Log'), ['action' => 'edit', $log->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Log'), ['action' => 'delete', $log->id], ['confirm' => __('Are you sure you want to delete # {0}?', $log->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Logs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Log'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Workouts'), ['controller' => 'Workouts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workout'), ['controller' => 'Workouts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Devices'), ['controller' => 'Devices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Device'), ['controller' => 'Devices', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="logs view large-9 medium-8 columns content">
    <h3><?= h($log->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Member') ?></th>
            <td><?= $log->has('member') ? $this->Html->link($log->member->id, ['controller' => 'Members', 'action' => 'view', $log->member->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Workout') ?></th>
            <td><?= $log->has('workout') ? $this->Html->link($log->workout->id, ['controller' => 'Workouts', 'action' => 'view', $log->workout->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Device') ?></th>
            <td><?= $log->has('device') ? $this->Html->link($log->device->id, ['controller' => 'Devices', 'action' => 'view', $log->device->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Log Type') ?></th>
            <td><?= h($log->log_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($log->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Location Latitude') ?></th>
            <td><?= $this->Number->format($log->location_latitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Location Logitude') ?></th>
            <td><?= $this->Number->format($log->location_logitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Log Value') ?></th>
            <td><?= $this->Number->format($log->log_value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($log->date) ?></td>
        </tr>
    </table>
</div>
