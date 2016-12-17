<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Abilities User'), ['action' => 'edit', $abilitiesUser->user_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Abilities User'), ['action' => 'delete', $abilitiesUser->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $abilitiesUser->user_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Abilities Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Abilities User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Abilities'), ['controller' => 'Abilities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ability'), ['controller' => 'Abilities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="abilitiesUsers view large-9 medium-8 columns content">
    <h3><?= h($abilitiesUser->user_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ability') ?></th>
            <td><?= $abilitiesUser->has('ability') ? $this->Html->link($abilitiesUser->ability->name, ['controller' => 'Abilities', 'action' => 'view', $abilitiesUser->ability->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $abilitiesUser->has('user') ? $this->Html->link($abilitiesUser->user->name, ['controller' => 'Users', 'action' => 'view', $abilitiesUser->user->id]) : '' ?></td>
        </tr>
    </table>
</div>
