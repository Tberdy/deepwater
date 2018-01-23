<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contest $contest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contest->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $contest->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Contests'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Workouts'), ['controller' => 'Workouts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Workout'), ['controller' => 'Workouts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contests form large-9 medium-8 columns content">
    <?= $this->Form->create($contest) ?>
    <fieldset>
        <legend><?= __('Edit Contest') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('type');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
