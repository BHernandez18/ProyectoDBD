
    <h3><?= __('Encargados') ?></h3>
    <?php echo $this->Form->create(null)?>
    <?php echo $this->Form->input('mission_id',['options'=>$missions, 'default' => $missionId, 'onchange'=>'this.form.submit()']);?>
    <noscript>< <?= $this->Form->submit(__('Seleccionar mision')) ?> </noscript>
    <?php echo $this->Form->end(); ?>
  <?php if($missionId!=null):?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
            
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mail') ?></th>
               
               
                <th scope="col"><?= $this->Paginator->sort('age') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('genre') ?></th>
              
                <th scope="col"><?= $this->Paginator->sort('region') ?></th>
                <th scope="col"><?= $this->Paginator->sort('score') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
      
            <?php foreach ($users as $user): ?>
            <tr>
              
                <td><?= h($user->name) ?></td>
                <td><?= h($user->mail) ?></td>
             
               
                <td><?= $this->Number->format($user->age) ?></td>
                <td><?= h($user->address) ?></td>
                <td><?= h($user->genre) ?></td>
              
                <td><?= h($user->region) ?></td>
                <td><?= $this->Number->format($user->score) ?></td>
                <td class="actions">
                    
                    <?= $this->Form->postLink(__('Asignar'), ['action' => 'assignEncargados', $user->id, $missionId]) ?>
                   
                   
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
    <?php endif;?>
    </div>
