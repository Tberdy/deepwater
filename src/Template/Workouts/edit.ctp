<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Workout $workout
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $workout->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $workout->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Workouts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Contests'), ['controller' => 'Contests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Contest'), ['controller' => 'Contests', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="workouts form large-9 medium-8 columns content">
    <?= $this->Form->create($workout) ?>
    <fieldset>
        <legend><?= __('Edit Workout') ?></legend>
        <?php
            echo $this->Form->control('member_id', ['options' => $members]);
            echo $this->Form->control('date');
            echo $this->Form->control('end_date');
            echo $this->Form->control('location_name');
            echo $this->Form->control('description');
            echo $this->Form->control('sport');
            echo $this->Form->control('contest_id', ['options' => $contests, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
