<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Manuals Request'), ['action' => 'edit', $manualsRequest->request_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Manuals Request'), ['action' => 'delete', $manualsRequest->request_id], ['confirm' => __('Are you sure you want to delete # {0}?', $manualsRequest->request_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Manuals Requests'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Manuals Request'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Manuals'), ['controller' => 'Manuals', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Manual'), ['controller' => 'Manuals', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="manualsRequests view large-9 medium-8 columns content">
    <h3><?= h($manualsRequest->request_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $manualsRequest->has('user') ? $this->Html->link($manualsRequest->user->name, ['controller' => 'Users', 'action' => 'view', $manualsRequest->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Manual') ?></th>
            <td><?= $manualsRequest->has('manual') ? $this->Html->link($manualsRequest->manual->name, ['controller' => 'Manuals', 'action' => 'view', $manualsRequest->manual->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Request Id') ?></th>
            <td><?= $this->Number->format($manualsRequest->request_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Request Date') ?></th>
            <td><?= h($manualsRequest->request_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Devolution Date') ?></th>
            <td><?= h($manualsRequest->devolution_date) ?></td>
        </tr>
    </table>
</div>
