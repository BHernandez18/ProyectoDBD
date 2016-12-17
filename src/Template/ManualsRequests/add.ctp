<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Manuals Requests'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Manuals'), ['controller' => 'Manuals', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Manual'), ['controller' => 'Manuals', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="manualsRequests form large-9 medium-8 columns content">
    <?= $this->Form->create($manualsRequest) ?>
    <fieldset>
        <legend><?= __('Add Manuals Request') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $requests]);
            echo $this->Form->input('manual_id', ['options' => $manuals]);
            echo $this->Form->input('request_date', ['empty' => true]);
            echo $this->Form->input('devolution_date', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
