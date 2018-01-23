<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bond $bond
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bond'), ['action' => 'edit', $bond->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Bond'), ['action' => 'delete', $bond->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bond->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bonds'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bond'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bonds view large-9 medium-8 columns content">
    <h3><?= h($bond->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Member') ?></th>
            <td><?= $bond->has('member') ? $this->Html->link($bond->member->id, ['controller' => 'Members', 'action' => 'view', $bond->member->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Member2 Id') ?></th>
            <td><?= h($bond->member2_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($bond->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Trusted') ?></th>
            <td><?= $bond->trusted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
