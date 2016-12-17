<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Call'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="calls index large-9 medium-8 columns content">
    <h3><?= __('Calls') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('manager_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('volunteer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('task_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($calls as $call): ?>
            <tr>
                <td><?= $this->Number->format($call->id) ?></td>
                <td><?= $this->Number->format($call->manager_id) ?></td>
                <td><?= $call->has('user') ? $this->Html->link($call->user->name, ['controller' => 'Users', 'action' => 'view', $call->user->id]) : '' ?></td>
                <td><?= $call->has('task') ? $this->Html->link($call->task->id, ['controller' => 'Tasks', 'action' => 'view', $call->task->id]) : '' ?></td>
                <td><?= h($call->date) ?></td>
                <td><?= $this->Number->format($call->state) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $call->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $call->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $call->id], ['confirm' => __('Are you sure you want to delete # {0}?', $call->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
