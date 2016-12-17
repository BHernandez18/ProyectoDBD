<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Call'), ['action' => 'edit', $call->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Call'), ['action' => 'delete', $call->id], ['confirm' => __('Are you sure you want to delete # {0}?', $call->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Calls'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Call'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="calls view large-9 medium-8 columns content">
    <h3><?= h($call->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $call->has('user') ? $this->Html->link($call->user->name, ['controller' => 'Users', 'action' => 'view', $call->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Task') ?></th>
            <td><?= $call->has('task') ? $this->Html->link($call->task->id, ['controller' => 'Tasks', 'action' => 'view', $call->task->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($call->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Manager Id') ?></th>
            <td><?= $this->Number->format($call->manager_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= $this->Number->format($call->state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($call->date) ?></td>
        </tr>
    </table>
</div>
