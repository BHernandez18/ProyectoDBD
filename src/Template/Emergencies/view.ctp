<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Emergency'), ['action' => 'edit', $emergency->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Emergency'), ['action' => 'delete', $emergency->id], ['confirm' => __('Are you sure you want to delete # {0}?', $emergency->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Emergencies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Emergency'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Missions'), ['controller' => 'Missions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mission'), ['controller' => 'Missions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="emergencies view large-9 medium-8 columns content">
    <h3><?= h($emergency->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $emergency->has('user') ? $this->Html->link($emergency->user->name, ['controller' => 'Users', 'action' => 'view', $emergency->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Place') ?></th>
            <td><?= h($emergency->place) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($emergency->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($emergency->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($emergency->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gravity') ?></th>
            <td><?= $this->Number->format($emergency->gravity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= $this->Number->format($emergency->state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($emergency->date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Missions') ?></h4>
        <?php if (!empty($emergency->missions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Emergency Id') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('Finish Date') ?></th>
                <th scope="col"><?= __('Region Mission') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($emergency->missions as $missions): ?>
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
</div>
