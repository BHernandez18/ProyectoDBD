<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $call->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $call->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Calls'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="calls form large-9 medium-8 columns content">
    <?= $this->Form->create($call) ?>
    <fieldset>
        <legend><?= __('Edit Call') ?></legend>
        <?php
            echo $this->Form->input('manager_id');
            echo $this->Form->input('volunteer_id', ['options' => $users]);
            echo $this->Form->input('task_id', ['options' => $tasks]);
            echo $this->Form->input('date', ['empty' => true]);
            echo $this->Form->input('state');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
