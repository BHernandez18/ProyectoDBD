<?= $this->Form->create($report) ?>
    <fieldset>
        <legend><?= __('Add Report') ?></legend>
        <?php
            echo $this->Form->input('task_id', ['options' => $tasks]);
       
   
            echo $this->Form->input('description');
            echo $this->Form->input('gravity',['options'=>[1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10]]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>