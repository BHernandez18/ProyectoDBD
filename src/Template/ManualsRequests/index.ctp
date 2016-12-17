<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Manuals Request'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Manuals'), ['controller' => 'Manuals', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Manual'), ['controller' => 'Manuals', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="manualsRequests index large-9 medium-8 columns content">
    <h3><?= __('Manuals Requests') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('request_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('manual_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('request_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('devolution_date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($manualsRequests as $manualsRequest): ?>
            <tr>
                <td><?= $this->Number->format($manualsRequest->request_id) ?></td>
                <td><?= $manualsRequest->has('user') ? $this->Html->link($manualsRequest->user->name, ['controller' => 'Users', 'action' => 'view', $manualsRequest->user->id]) : '' ?></td>
                <td><?= $manualsRequest->has('manual') ? $this->Html->link($manualsRequest->manual->name, ['controller' => 'Manuals', 'action' => 'view', $manualsRequest->manual->id]) : '' ?></td>
                <td><?= h($manualsRequest->request_date) ?></td>
                <td><?= h($manualsRequest->devolution_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $manualsRequest->request_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $manualsRequest->request_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $manualsRequest->request_id], ['confirm' => __('Are you sure you want to delete # {0}?', $manualsRequest->request_id)]) ?>
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
