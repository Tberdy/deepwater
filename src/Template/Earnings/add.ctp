<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Earning $earning
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Earnings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stickers'), ['controller' => 'Stickers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sticker'), ['controller' => 'Stickers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="earnings form large-9 medium-8 columns content">
    <?= $this->Form->create($earning) ?>
    <fieldset>
        <legend><?= __('Add Earning') ?></legend>
        <?php
            echo $this->Form->control('member_id', ['options' => $members]);
            echo $this->Form->control('sticker_id', ['options' => $stickers]);
            echo $this->Form->control('date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
