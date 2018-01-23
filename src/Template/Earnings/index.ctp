<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Earning[]|\Cake\Collection\CollectionInterface $earnings
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Earning'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stickers'), ['controller' => 'Stickers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sticker'), ['controller' => 'Stickers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="earnings index large-9 medium-8 columns content">
    <h3><?= __('Earnings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('member_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sticker_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($earnings as $earning): ?>
            <tr>
                <td><?= $this->Number->format($earning->id) ?></td>
                <td><?= $earning->has('member') ? $this->Html->link($earning->member->id, ['controller' => 'Members', 'action' => 'view', $earning->member->id]) : '' ?></td>
                <td><?= $earning->has('sticker') ? $this->Html->link($earning->sticker->name, ['controller' => 'Stickers', 'action' => 'view', $earning->sticker->id]) : '' ?></td>
                <td><?= h($earning->date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $earning->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $earning->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $earning->id], ['confirm' => __('Are you sure you want to delete # {0}?', $earning->id)]) ?>
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
