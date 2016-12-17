<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Missions'), ['controller' => 'Missions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mission'), ['controller' => 'Missions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Manuals Requests'), ['controller' => 'ManualsRequests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Manuals Request'), ['controller' => 'ManualsRequests', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reports'), ['controller' => 'Reports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Report'), ['controller' => 'Reports', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Abilities'), ['controller' => 'Abilities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ability'), ['controller' => 'Abilities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('mission_id', ['options' => $missions, 'empty' => true]);
            echo $this->Form->input('adm_enc_id', ['options' => $admins, 'empty' => true]);
            echo $this->Form->input('run');
            echo $this->Form->input('password');
            echo $this->Form->input('name');
            echo $this->Form->input('mail');
            echo $this->Form->input('volunteer_state');
            echo $this->Form->input('user_type');
            echo $this->Form->input('age');
            echo $this->Form->input('address');
            echo $this->Form->input('genre');
            echo $this->Form->input('phone');
            echo $this->Form->input('region');
            echo $this->Form->input('score');
            echo $this->Form->input('abilities._ids', ['options' => $abilities]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
