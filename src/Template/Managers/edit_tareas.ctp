
    <?= $this->Form->create($task) ?>
    <fieldset>
        <legend><?= __('Edit Task') ?></legend>
        <?php
            echo $this->Form->input('mission_id', ['options' => $missions]);
            echo $this->Form->input('state',['options'=>['FINALIZADO'=>'FINALIZADO','NO FINALIZADO'=>'NO FINALIZADO']]);
            echo $this->Form->input('name');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
