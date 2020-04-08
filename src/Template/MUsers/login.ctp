<div class="users form">
    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?>
    <div style='margin-left: auto; margin-right: auto; width: 550px;'>
        <fieldset>
            <legend><?= __('メールアドレスとパスワードを入力してください') ?></legend>
            <?= $this->Form->control('email') ?>
            <?= $this->Form->control('password') ?>
        </fieldset>
        <?= $this->Form->button(__('Login')); ?>
    </div>
    <?= $this->Form->end() ?>
</div>