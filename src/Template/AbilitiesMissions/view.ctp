<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Abilities Mission'), ['action' => 'edit', $abilitiesMission->mission_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Abilities Mission'), ['action' => 'delete', $abilitiesMission->mission_id], ['confirm' => __('Are you sure you want to delete # {0}?', $abilitiesMission->mission_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Abilities Missions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Abilities Mission'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Missions'), ['controller' => 'Missions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mission'), ['controller' => 'Missions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Abilities'), ['controller' => 'Abilities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ability'), ['controller' => 'Abilities', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="abilitiesMissions view large-9 medium-8 columns content">
    <h3><?= h($abilitiesMission->mission_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Mission') ?></th>
            <td><?= $abilitiesMission->has('mission') ? $this->Html->link($abilitiesMission->mission->id, ['controller' => 'Missions', 'action' => 'view', $abilitiesMission->mission->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ability') ?></th>
            <td><?= $abilitiesMission->has('ability') ? $this->Html->link($abilitiesMission->ability->name, ['controller' => 'Abilities', 'action' => 'view', $abilitiesMission->ability->id]) : '' ?></td>
        </tr>
    </table>
</div>
