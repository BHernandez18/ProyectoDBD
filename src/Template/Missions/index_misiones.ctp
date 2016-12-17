<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Mission'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Emergencies'), ['controller' => 'Emergencies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Emergency'), ['controller' => 'Emergencies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Abilities'), ['controller' => 'Abilities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ability'), ['controller' => 'Abilities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="missions index large-9 medium-8 columns content">
    <h3><?= __('Missions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('emergency_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('finish_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('region_mission') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($missions as $mission): ?>
            <tr>
                <td><?= $this->Number->format($mission->id) ?></td>
                <td><?= $mission->has('emergency') ? $this->Html->link($mission->emergency->id, ['controller' => 'Emergencies', 'action' => 'view', $mission->emergency->id]) : '' ?></td>
                <td><?= h($mission->start_date) ?></td>
                <td><?= h($mission->finish_date) ?></td>
                <td><?= h($mission->region_mission) ?></td>
                <td><?= h($mission->name) ?></td>
                <td><?= h($mission->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mission->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mission->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mission->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mission->id)]) ?>
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
