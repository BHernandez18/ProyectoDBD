<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Missions'), ['controller' => 'Missions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mission'), ['controller' => 'Missions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Manuals Requests'), ['controller' => 'ManualsRequests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Manuals Request'), ['controller' => 'ManualsRequests', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reports'), ['controller' => 'Reports', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Report'), ['controller' => 'Reports', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Abilities'), ['controller' => 'Abilities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ability'), ['controller' => 'Abilities', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Mission') ?></th>
            <td><?= $user->has('mission') ? $this->Html->link($user->mission->id, ['controller' => 'Missions', 'action' => 'view', $user->mission->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $user->has('user') ? $this->Html->link($user->user->name, ['controller' => 'Users', 'action' => 'view', $user->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Run') ?></th>
            <td><?= h($user->run) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mail') ?></th>
            <td><?= h($user->mail) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Volunteer State') ?></th>
            <td><?= h($user->volunteer_state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Type') ?></th>
            <td><?= h($user->user_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($user->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Genre') ?></th>
            <td><?= h($user->genre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($user->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Region') ?></th>
            <td><?= h($user->region) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Age') ?></th>
            <td><?= $this->Number->format($user->age) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Score') ?></th>
            <td><?= $this->Number->format($user->score) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Manuals Requests') ?></h4>
        <?php if (!empty($user->manuals_requests)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Request Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Manual Id') ?></th>
                <th scope="col"><?= __('Request Date') ?></th>
                <th scope="col"><?= __('Devolution Date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->manuals_requests as $manualsRequests): ?>
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
    <div class="related">
        <h4><?= __('Related Reports') ?></h4>
        <?php if (!empty($user->reports)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Task Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Entry Date') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Gravity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->reports as $reports): ?>
            <tr>
                <td><?= h($reports->id) ?></td>
                <td><?= h($reports->task_id) ?></td>
                <td><?= h($reports->user_id) ?></td>
                <td><?= h($reports->entry_date) ?></td>
                <td><?= h($reports->description) ?></td>
                <td><?= h($reports->gravity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Reports', 'action' => 'view', $reports->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Reports', 'action' => 'edit', $reports->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reports', 'action' => 'delete', $reports->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reports->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Abilities') ?></h4>
        <?php if (!empty($user->abilities)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->abilities as $abilities): ?>
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
