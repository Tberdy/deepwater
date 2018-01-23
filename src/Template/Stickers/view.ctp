<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sticker $sticker
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sticker'), ['action' => 'edit', $sticker->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sticker'), ['action' => 'delete', $sticker->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sticker->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Stickers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sticker'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Earnings'), ['controller' => 'Earnings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Earning'), ['controller' => 'Earnings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="stickers view large-9 medium-8 columns content">
    <h3><?= h($sticker->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($sticker->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($sticker->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($sticker->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Earnings') ?></h4>
        <?php if (!empty($sticker->earnings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Member Id') ?></th>
                <th scope="col"><?= __('Sticker Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($sticker->earnings as $earnings): ?>
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
</div>
