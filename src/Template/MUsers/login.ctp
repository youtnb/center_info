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
<div style="clear: both;"></div>
<div style='margin-left: auto; margin-right: auto; margin-top: 50px; width: 800px;'>
    <fieldset>
        <legend><?= __('お知らせ') ?></legend>
        <?php foreach ($informations as $info): ?>
        [&nbsp;<?= $info->created->format('Y/m/d') ?>&nbsp;]<?= $this->Text->autoParagraph(h($info->content)) ?>
        <?php endforeach; ?>
    </fieldset>
</div>
