    <h3><?= __('Calls') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('manager_id') ?></th>
             
                <th scope="col"><?= $this->Paginator->sort('task_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($calls as $call): ?>
            <tr>
                <td><?= $this->Number->format($call->id) ?></td>
                <td><?= $this->Number->format($call->manager_id) ?></td>

                <td><?= $call->task->name;?></td>

                <td><?= h($call->date) ?></td>
                <td><?= $call->state ?></td>
                <td class="actions">
               
                    <?= $this->Html->link(__('Aceptar Llamado'), ['action' => 'accept', $call->id]) ?>
                  
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
