<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Abilities Mission'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Missions'), ['controller' => 'Missions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mission'), ['controller' => 'Missions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Abilities'), ['controller' => 'Abilities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ability'), ['controller' => 'Abilities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="abilitiesMissions index large-9 medium-8 columns content">
    <h3><?= __('Abilities Missions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('mission_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ability_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($abilitiesMissions as $abilitiesMission): ?>
            <tr>
                <td><?= $abilitiesMission->has('mission') ? $this->Html->link($abilitiesMission->mission->id, ['controller' => 'Missions', 'action' => 'view', $abilitiesMission->mission->id]) : '' ?></td>
                <td><?= $abilitiesMission->has('ability') ? $this->Html->link($abilitiesMission->ability->name, ['controller' => 'Abilities', 'action' => 'view', $abilitiesMission->ability->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $abilitiesMission->mission_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $abilitiesMission->mission_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $abilitiesMission->mission_id], ['confirm' => __('Are you sure you want to delete # {0}?', $abilitiesMission->mission_id)]) ?>
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
