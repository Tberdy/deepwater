<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Member $member
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Member'), ['action' => 'edit', $member->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Member'), ['action' => 'delete', $member->id], ['confirm' => __('Are you sure you want to delete # {0}?', $member->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bonds'), ['controller' => 'Bonds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bond'), ['controller' => 'Bonds', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Devices'), ['controller' => 'Devices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Device'), ['controller' => 'Devices', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Earnings'), ['controller' => 'Earnings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Earning'), ['controller' => 'Earnings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Messages'), ['controller' => 'Messages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message'), ['controller' => 'Messages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Workouts'), ['controller' => 'Workouts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workout'), ['controller' => 'Workouts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="members view large-9 medium-8 columns content">
    <h3><?= h($member->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($member->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($member->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($member->password) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bonds') ?></h4>
        <?php if (!empty($member->bonds)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Member Id') ?></th>
                <th scope="col"><?= __('Member2 Id') ?></th>
                <th scope="col"><?= __('Trusted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($member->bonds as $bonds): ?>
            <tr>
                <td><?= h($bonds->id) ?></td>
                <td><?= h($bonds->member_id) ?></td>
                <td><?= h($bonds->member2_id) ?></td>
                <td><?= h($bonds->trusted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bonds', 'action' => 'view', $bonds->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bonds', 'action' => 'edit', $bonds->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bonds', 'action' => 'delete', $bonds->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bonds->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Devices') ?></h4>
        <?php if (!empty($member->devices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Member Id') ?></th>
                <th scope="col"><?= __('Serial') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Trusted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($member->devices as $devices): ?>
            <tr>
                <td><?= h($devices->id) ?></td>
                <td><?= h($devices->member_id) ?></td>
                <td><?= h($devices->serial) ?></td>
                <td><?= h($devices->description) ?></td>
                <td><?= h($devices->trusted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Devices', 'action' => 'view', $devices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Devices', 'action' => 'edit', $devices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Devices', 'action' => 'delete', $devices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $devices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Earnings') ?></h4>
        <?php if (!empty($member->earnings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Member Id') ?></th>
                <th scope="col"><?= __('Sticker Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($member->earnings as $earnings): ?>
            <tr>
                <td><?= h($earnings->id) ?></td>
                <td><?= h($earnings->member_id) ?></td>
                <td><?= h($earnings->sticker_id) ?></td>
                <td><?= h($earnings->date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Earnings', 'action' => 'view', $earnings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Earnings', 'action' => 'edit', $earnings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Earnings', 'action' => 'delete', $earnings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $earnings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Logs') ?></h4>
        <?php if (!empty($member->logs)): ?>
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
            <?php foreach ($member->logs as $logs): ?>
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
    <div class="related">
        <h4><?= __('Related Messages') ?></h4>
        <?php if (!empty($member->messages)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Member Id') ?></th>
                <th scope="col"><?= __('Member2 Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Read') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($member->messages as $messages): ?>
            <tr>
                <td><?= h($messages->id) ?></td>
                <td><?= h($messages->member_id) ?></td>
                <td><?= h($messages->member2_id) ?></td>
                <td><?= h($messages->date) ?></td>
                <td><?= h($messages->name) ?></td>
                <td><?= h($messages->description) ?></td>
                <td><?= h($messages->read) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Messages', 'action' => 'view', $messages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Messages', 'action' => 'edit', $messages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Messages', 'action' => 'delete', $messages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $messages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Workouts') ?></h4>
        <?php if (!empty($member->workouts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Member Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('End Date') ?></th>
                <th scope="col"><?= __('Location Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Sport') ?></th>
                <th scope="col"><?= __('Contest Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($member->workouts as $workouts): ?>
            <tr>
                <td><?= h($workouts->id) ?></td>
                <td><?= h($workouts->member_id) ?></td>
                <td><?= h($workouts->date) ?></td>
                <td><?= h($workouts->end_date) ?></td>
                <td><?= h($workouts->location_name) ?></td>
                <td><?= h($workouts->description) ?></td>
                <td><?= h($workouts->sport) ?></td>
                <td><?= h($workouts->contest_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Workouts', 'action' => 'view', $workouts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Workouts', 'action' => 'edit', $workouts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Workouts', 'action' => 'delete', $workouts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workouts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
