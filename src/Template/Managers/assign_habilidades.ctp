
    <?= $this->Form->create($abilitiesMission) ?>
    <fieldset>
        <legend><?= __('Add Abilities Mission') ?></legend>
        <?php

            echo $this->Form->input('ability');
          

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
