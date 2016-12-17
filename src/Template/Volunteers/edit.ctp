
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
          
      
            echo $this->Form->input('run');
            echo $this->Form->input('password');
            echo $this->Form->input('name');
            echo $this->Form->input('mail');
            echo $this->Form->input('volunteer_state',['options'=>['DISPONIBLE'=>'DISPONIBLE','NO DISPONIBLE'=>'NO DISPONIBLE']]);
     
            echo $this->Form->input('age');
            echo $this->Form->input('address');
            echo $this->Form->input('genre');
            echo $this->Form->input('phone');
            echo $this->Form->input('region');
    
            echo $this->Form->input('abilities._ids', ['options' => $abilities]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
