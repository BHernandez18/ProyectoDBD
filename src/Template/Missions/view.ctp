<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Mission'), ['action' => 'edit', $mission->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Mission'), ['action' => 'delete', $mission->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mission->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Missions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mission'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Emergencies'), ['controller' => 'Emergencies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Emergency'), ['controller' => 'Emergencies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Abilities'), ['controller' => 'Abilities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ability'), ['controller' => 'Abilities', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="missions view large-9 medium-8 columns content">
    <h3><?= h($mission->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Emergency') ?></th>
            <td><?= $mission->has('emergency') ? $this->Html->link($mission->emergency->id, ['controller' => 'Emergencies', 'action' => 'view', $mission->emergency->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Region Mission') ?></th>
            <td><?= h($mission->region_mission) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($mission->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($mission->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mission->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($mission->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Finish Date') ?></th>
            <td><?= h($mission->finish_date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Tasks') ?></h4>
        <?php if (!empty($mission->tasks)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Mission Id') ?></th>
                <th scope="col"><?= __('State') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mission->tasks as $tasks): ?>
            <tr>
                <td><?= h($tasks->id) ?></td>
                <td><?= h($tasks->mission_id) ?></td>
                <td><?= h($tasks->state) ?></td>
                <td><?= h($tasks->name) ?></td>
                <td><?= h($tasks->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tasks', 'action' => 'view', $tasks->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tasks', 'action' => 'edit', $tasks->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tasks', 'action' => 'delete', $tasks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tasks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($mission->users)): ?>
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
            <?php foreach ($mission->users as $users): ?>
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
    <div class="related">
        <h4><?= __('Related Abilities') ?></h4>
        <?php if (!empty($mission->abilities)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mission->abilities as $abilities): ?>
            <tr>
                <td><?= h($abilities->id) ?></td>
                <td><?= h($abilities->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Abilities', 'action' => 'view', $abilities->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Abilities', 'action' => 'edit', $abilities->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Abilities', 'action' => 'delete', $abilities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abilities->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
