<h3><?= __('Habilidades') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" width=5%><?= $this->Paginator->sort('id') ?></th>
                <th scope="col" width=85%><?= $this->Paginator->sort('name') ?></th>
              
            </tr>
        </thead>
        <tbody>
            <?php foreach ($abilities as $ability): ?>
            <tr>
                <td><?= $this->Number->format($ability->id) ?></td>
                <td><?= h($ability->name) ?></td>               
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