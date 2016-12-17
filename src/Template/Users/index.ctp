<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Missions'), ['controller' => 'Missions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mission'), ['controller' => 'Missions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Manuals Requests'), ['controller' => 'ManualsRequests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Manuals Request'), ['controller' => 'ManualsRequests', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reports'), ['controller' => 'Reports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Report'), ['controller' => 'Reports', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Abilities'), ['controller' => 'Abilities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ability'), ['controller' => 'Abilities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mission_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adm_enc_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('run') ?></th>
                <th scope="col"><?= $this->Paginator->sort('password') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mail') ?></th>
                <th scope="col"><?= $this->Paginator->sort('volunteer_state') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('age') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('genre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('region') ?></th>
                <th scope="col"><?= $this->Paginator->sort('score') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= $user->has('mission') ? $this->Html->link($user->mission->id, ['controller' => 'Missions', 'action' => 'view', $user->mission->id]) : '' ?></td>
                <td><?= $user->has('user') ? $this->Html->link($user->user->name, ['controller' => 'Users', 'action' => 'view', $user->user->id]) : '' ?></td>
                <td><?= h($user->run) ?></td>
                <td><?= h($user->password) ?></td>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->mail) ?></td>
                <td><?= h($user->volunteer_state) ?></td>
                <td><?= h($user->user_type) ?></td>
                <td><?= $this->Number->format($user->age) ?></td>
                <td><?= h($user->address) ?></td>
                <td><?= h($user->genre) ?></td>
                <td><?= h($user->phone) ?></td>
                <td><?= h($user->region) ?></td>
                <td><?= $this->Number->format($user->score) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
