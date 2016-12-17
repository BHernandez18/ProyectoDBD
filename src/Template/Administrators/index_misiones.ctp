    <h3><?= __('Misiones') ?></h3>
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
                    <?= $this->Html->link(__('Edit'), ['action' => 'editMisiones', $mission->id]) ?>
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

