<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Emergencies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Missions'), ['controller' => 'Missions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mission'), ['controller' => 'Missions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="emergencies form large-9 medium-8 columns content">
    <?= $this->Form->create($emergency) ?>
    <fieldset>
        <legend><?= __('Add Emergency') ?></legend>
        <?php
            echo $this->Form->input('admin_id', ['options' => $users]);
            echo $this->Form->input('place');
            echo $this->Form->input('date', ['empty' => true]);
            echo $this->Form->input('gravity');
            echo $this->Form->input('description');
            echo $this->Form->input('state');
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
