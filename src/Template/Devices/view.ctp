<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device $device
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Device'), ['action' => 'edit', $device->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Device'), ['action' => 'delete', $device->id], ['confirm' => __('Are you sure you want to delete # {0}?', $device->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Devices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Device'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="devices view large-9 medium-8 columns content">
    <h3><?= h($device->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Member') ?></th>
            <td><?= $device->has('member') ? $this->Html->link($device->member->id, ['controller' => 'Members', 'action' => 'view', $device->member->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Serial') ?></th>
            <td><?= h($device->serial) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($device->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($device->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Trusted') ?></th>
            <td><?= $device->trusted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Logs') ?></h4>
        <?php if (!empty($device->logs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Member Id') ?></th>
                <th scope="col"><?= __('Workout Id') ?></th>
                <th scope="col"><?= __('Device Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Location Latitude') ?></th>
                <th scope="col"><?= __('Location Logitude') ?></th>
                <th scope="col"><?= __('Log Type') ?></th>
                <th scope="col"><?= __('Log Value') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($device->logs as $logs): ?>
            <tr>
                <td><?= h($logs->id) ?></td>
                <td><?= h($logs->member_id) ?></td>
                <td><?= h($logs->workout_id) ?></td>
                <td><?= h($logs->device_id) ?></td>
                <td><?= h($logs->date) ?></td>
                <td><?= h($logs->location_latitude) ?></td>
                <td><?= h($logs->location_logitude) ?></td>
                <td><?= h($logs->log_type) ?></td>
                <td><?= h($logs->log_value) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Logs', 'action' => 'view', $logs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Logs', 'action' => 'edit', $logs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Logs', 'action' => 'delete', $logs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
