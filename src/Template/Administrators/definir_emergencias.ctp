

    <?= $this->Form->create($emergency) ?>
    <fieldset>
        <legend><?= __('Crear Emergencia') ?></legend>
        <?php
            echo $this->Form->input('admin_id', ['options' => $users]);
            echo $this->Form->input('place');
            echo $this->Form->input('date', ['empty' => true]);
            echo $this->Form->input('gravity');
            echo $this->Form->input('description');
            echo $this->Form->input('state');
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

