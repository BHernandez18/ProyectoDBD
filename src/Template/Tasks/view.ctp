<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Task'), ['action' => 'edit', $task->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Task'), ['action' => 'delete', $task->id], ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Missions'), ['controller' => 'Missions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mission'), ['controller' => 'Missions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Calls'), ['controller' => 'Calls', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Call'), ['controller' => 'Calls', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Manuals'), ['controller' => 'Manuals', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Manual'), ['controller' => 'Manuals', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reports'), ['controller' => 'Reports', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Report'), ['controller' => 'Reports', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tasks view large-9 medium-8 columns content">
    <h3><?= h($task->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Mission') ?></th>
            <td><?= $task->has('mission') ? $this->Html->link($task->mission->id, ['controller' => 'Missions', 'action' => 'view', $task->mission->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= h($task->state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($task->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($task->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($task->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Calls') ?></h4>
        <?php if (!empty($task->calls)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Manager Id') ?></th>
                <th scope="col"><?= __('Volunteer Id') ?></th>
                <th scope="col"><?= __('Task Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('State') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($task->calls as $calls): ?>
            <tr>
                <td><?= h($calls->id) ?></td>
                <td><?= h($calls->manager_id) ?></td>
                <td><?= h($calls->volunteer_id) ?></td>
                <td><?= h($calls->task_id) ?></td>
                <td><?= h($calls->date) ?></td>
                <td><?= h($calls->state) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Calls', 'action' => 'view', $calls->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Calls', 'action' => 'edit', $calls->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Calls', 'action' => 'delete', $calls->id], ['confirm' => __('Are you sure you want to delete # {0}?', $calls->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Manuals') ?></h4>
        <?php if (!empty($task->manuals)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Task Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($task->manuals as $manuals): ?>
            <tr>
                <td><?= h($manuals->id) ?></td>
                <td><?= h($manuals->task_id) ?></td>
                <td><?= h($manuals->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Manuals', 'action' => 'view', $manuals->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Manuals', 'action' => 'edit', $manuals->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Manuals', 'action' => 'delete', $manuals->id], ['confirm' => __('Are you sure you want to delete # {0}?', $manuals->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Reports') ?></h4>
        <?php if (!empty($task->reports)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Task Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Entry Date') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Gravity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($task->reports as $reports): ?>
            <tr>
                <td><?= h($reports->id) ?></td>
                <td><?= h($reports->task_id) ?></td>
                <td><?= h($reports->user_id) ?></td>
                <td><?= h($reports->entry_date) ?></td>
                <td><?= h($reports->description) ?></td>
                <td><?= h($reports->gravity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Reports', 'action' => 'view', $reports->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Reports', 'action' => 'edit', $reports->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reports', 'action' => 'delete', $reports->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reports->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
