<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Manual'), ['action' => 'edit', $manual->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Manual'), ['action' => 'delete', $manual->id], ['confirm' => __('Are you sure you want to delete # {0}?', $manual->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Manuals'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Manual'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Manuals Requests'), ['controller' => 'ManualsRequests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Manuals Request'), ['controller' => 'ManualsRequests', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="manuals view large-9 medium-8 columns content">
    <h3><?= h($manual->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Task') ?></th>
            <td><?= $manual->has('task') ? $this->Html->link($manual->task->id, ['controller' => 'Tasks', 'action' => 'view', $manual->task->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($manual->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($manual->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Manuals Requests') ?></h4>
        <?php if (!empty($manual->manuals_requests)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Request Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Manual Id') ?></th>
                <th scope="col"><?= __('Request Date') ?></th>
                <th scope="col"><?= __('Devolution Date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($manual->manuals_requests as $manualsRequests): ?>
            <tr>
                <td><?= h($manualsRequests->request_id) ?></td>
                <td><?= h($manualsRequests->user_id) ?></td>
                <td><?= h($manualsRequests->manual_id) ?></td>
                <td><?= h($manualsRequests->request_date) ?></td>
                <td><?= h($manualsRequests->devolution_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ManualsRequests', 'action' => 'view', $manualsRequests->request_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ManualsRequests', 'action' => 'edit', $manualsRequests->request_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ManualsRequests', 'action' => 'delete', $manualsRequests->request_id], ['confirm' => __('Are you sure you want to delete # {0}?', $manualsRequests->request_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
