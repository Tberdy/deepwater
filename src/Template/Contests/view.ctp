<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contest $contest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Contest'), ['action' => 'edit', $contest->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Contest'), ['action' => 'delete', $contest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contest->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Contests'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contest'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Workouts'), ['controller' => 'Workouts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workout'), ['controller' => 'Workouts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contests view large-9 medium-8 columns content">
    <h3><?= h($contest->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($contest->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($contest->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($contest->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($contest->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Workouts') ?></h4>
        <?php if (!empty($contest->workouts)): ?>
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
            <?php foreach ($contest->workouts as $workouts): ?>
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
