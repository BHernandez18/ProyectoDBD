

    
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
