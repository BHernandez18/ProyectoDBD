<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Manuals'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Manuals Requests'), ['controller' => 'ManualsRequests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Manuals Request'), ['controller' => 'ManualsRequests', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="manuals form large-9 medium-8 columns content">
    <?= $this->Form->create($manual) ?>
    <fieldset>
        <legend><?= __('Add Manual') ?></legend>
        <?php
            echo $this->Form->input('task_id', ['options' => $tasks]);
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
