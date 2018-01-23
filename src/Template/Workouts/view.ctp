<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Workout $workout
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Workout'), ['action' => 'edit', $workout->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Workout'), ['action' => 'delete', $workout->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workout->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Workouts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workout'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Contests'), ['controller' => 'Contests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contest'), ['controller' => 'Contests', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="workouts view large-9 medium-8 columns content">
    <h3><?= h($workout->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Member') ?></th>
            <td><?= $workout->has('member') ? $this->Html->link($workout->member->id, ['controller' => 'Members', 'action' => 'view', $workout->member->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Location Name') ?></th>
            <td><?= h($workout->location_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sport') ?></th>
            <td><?= h($workout->sport) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contest') ?></th>
            <td><?= $workout->has('contest') ? $this->Html->link($workout->contest->name, ['controller' => 'Contests', 'action' => 'view', $workout->contest->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($workout->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($workout->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($workout->end_date) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($workout->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Logs') ?></h4>
        <?php if (!empty($workout->logs)): ?>
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
            <?php foreach ($workout->logs as $logs): ?>
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
