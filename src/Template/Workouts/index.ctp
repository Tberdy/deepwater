<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Workout[]|\Cake\Collection\CollectionInterface $workouts
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Workout'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Contests'), ['controller' => 'Contests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Contest'), ['controller' => 'Contests', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="workouts index large-9 medium-8 columns content">
    <h3><?= __('Workouts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('member_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('location_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sport') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contest_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($workouts as $workout): ?>
            <tr>
                <td><?= $this->Number->format($workout->id) ?></td>
                <td><?= $workout->has('member') ? $this->Html->link($workout->member->id, ['controller' => 'Members', 'action' => 'view', $workout->member->id]) : '' ?></td>
                <td><?= h($workout->date) ?></td>
                <td><?= h($workout->end_date) ?></td>
                <td><?= h($workout->location_name) ?></td>
                <td><?= h($workout->sport) ?></td>
                <td><?= $workout->has('contest') ? $this->Html->link($workout->contest->name, ['controller' => 'Contests', 'action' => 'view', $workout->contest->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $workout->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $workout->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $workout->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workout->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
