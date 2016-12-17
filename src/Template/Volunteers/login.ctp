<!-- File: src/Template/Users/login.ctp -->

<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
</div>
<button class="btn btn.default">
<?= $this->Html->link(__('Sign Up'), ['controller' => 'Volunteers', 'action' => 'add'], ['style' => 'color:#EEEEEE']) ?>

</div>