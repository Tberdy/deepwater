<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sticker[]|\Cake\Collection\CollectionInterface $stickers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sticker'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Earnings'), ['controller' => 'Earnings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Earning'), ['controller' => 'Earnings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stickers index large-9 medium-8 columns content">
    <h3><?= __('Stickers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stickers as $sticker): ?>
            <tr>
                <td><?= $this->Number->format($sticker->id) ?></td>
                <td><?= h($sticker->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $sticker->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $sticker->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sticker->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sticker->id)]) ?>
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
