
    <h3><?= __('Emergencias') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
             
                <th scope="col"><?= $this->Paginator->sort('admin_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('place') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gravity') ?></th>
                <th scope="col" width=25%><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                <th scope="col" width=15%><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($emergencies as $emergency): ?>
            <tr>
              
                <td><?= $emergency->has('user') ? $this->Html->link($emergency->user->name, ['controller' => 'Users', 'action' => 'view', $emergency->user->id]) : '' ?></td>
                <td><?= h($emergency->place) ?></td>
                <td><?= h($emergency->date) ?></td>
                <td><?= $this->Number->format($emergency->gravity) ?></td>
                <td><?= h($emergency->description) ?></td>
                <td><?= $this->Number->format($emergency->state) ?></td>
                <td><?= h($emergency->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'viewEmergencies', $emergency->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'editEmergencies', $emergency->id]) ?>
                 
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

