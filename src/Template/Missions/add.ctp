<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Missions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Emergencies'), ['controller' => 'Emergencies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Emergency'), ['controller' => 'Emergencies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Abilities'), ['controller' => 'Abilities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ability'), ['controller' => 'Abilities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="missions form large-9 medium-8 columns content">
    <?= $this->Form->create($mission) ?>
    <fieldset>
        <legend><?= __('Add Mission') ?></legend>
        <?php
            echo $this->Form->input('emergency_id', ['options' => $emergencies]);
            echo $this->Form->input('start_date', ['empty' => true]);
            echo $this->Form->input('finish_date', ['empty' => true]);
            echo $this->Form->input('region_mission');
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('abilities._ids', ['options' => $abilities]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
