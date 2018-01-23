<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bond $bond
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $bond->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $bond->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Bonds'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bonds form large-9 medium-8 columns content">
    <?= $this->Form->create($bond) ?>
    <fieldset>
        <legend><?= __('Edit Bond') ?></legend>
        <?php
            echo $this->Form->control('member_id', ['options' => $members]);
            echo $this->Form->control('member2_id');
            echo $this->Form->control('trusted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
