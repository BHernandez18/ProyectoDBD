
    <?= $this->Form->create($ability) ?>
    <fieldset>
        <legend><?= __('Agregar Habilidad') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

