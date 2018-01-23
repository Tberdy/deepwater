<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Earning $earning
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Earning'), ['action' => 'edit', $earning->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Earning'), ['action' => 'delete', $earning->id], ['confirm' => __('Are you sure you want to delete # {0}?', $earning->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Earnings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Earning'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stickers'), ['controller' => 'Stickers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sticker'), ['controller' => 'Stickers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="earnings view large-9 medium-8 columns content">
    <h3><?= h($earning->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Member') ?></th>
            <td><?= $earning->has('member') ? $this->Html->link($earning->member->id, ['controller' => 'Members', 'action' => 'view', $earning->member->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sticker') ?></th>
            <td><?= $earning->has('sticker') ? $this->Html->link($earning->sticker->name, ['controller' => 'Stickers', 'action' => 'view', $earning->sticker->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($earning->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($earning->date) ?></td>
        </tr>
    </table>
</div>
