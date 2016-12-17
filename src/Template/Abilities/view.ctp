<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ability'), ['action' => 'edit', $ability->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ability'), ['action' => 'delete', $ability->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ability->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Abilities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ability'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Missions'), ['controller' => 'Missions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mission'), ['controller' => 'Missions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="abilities view large-9 medium-8 columns content">
    <h3><?= h($ability->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($ability->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ability->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Missions') ?></h4>
        <?php if (!empty($ability->missions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Emergency Id') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('Finish Date') ?></th>
                <th scope="col"><?= __('Region Mission') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($ability->missions as $missions): ?>
            <tr>
                <td><?= h($missions->id) ?></td>
                <td><?= h($missions->emergency_id) ?></td>
                <td><?= h($missions->start_date) ?></td>
                <td><?= h($missions->finish_date) ?></td>
                <td><?= h($missions->region_mission) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Missions', 'action' => 'view', $missions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Missions', 'action' => 'edit', $missions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Missions', 'action' => 'delete', $missions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $missions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($ability->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Mission Id') ?></th>
                <th scope="col"><?= __('Adm Enc Id') ?></th>
                <th scope="col"><?= __('Run') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Mail') ?></th>
                <th scope="col"><?= __('Volunteer State') ?></th>
                <th scope="col"><?= __('User Type') ?></th>
                <th scope="col"><?= __('Age') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Genre') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Region') ?></th>
                <th scope="col"><?= __('Score') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($ability->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->mission_id) ?></td>
                <td><?= h($users->adm_enc_id) ?></td>
                <td><?= h($users->run) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->name) ?></td>
                <td><?= h($users->mail) ?></td>
                <td><?= h($users->volunteer_state) ?></td>
                <td><?= h($users->user_type) ?></td>
                <td><?= h($users->age) ?></td>
                <td><?= h($users->address) ?></td>
                <td><?= h($users->genre) ?></td>
                <td><?= h($users->phone) ?></td>
                <td><?= h($users->region) ?></td>
                <td><?= h($users->score) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
