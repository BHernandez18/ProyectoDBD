<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php

            echo $this->Form->input('run');
            echo $this->Form->input('password');
            echo $this->Form->input('name');
            echo $this->Form->input('mail');
  
  
            echo $this->Form->input('age');
            echo $this->Form->input('address');
            echo $this->Form->input('genre',['options'=>['F'=>'Femenino','M'=>'Masculino']]);
            echo $this->Form->input('phone');
            echo $this->Form->input('region');
    
            echo $this->Form->input('abilities._ids', ['options' => $abilities]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
