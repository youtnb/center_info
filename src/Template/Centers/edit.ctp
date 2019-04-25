<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Center $center
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= TITLE_CENTER ?></li>
        <li><?= $this->Html->link(__('一覧'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('登録'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('閲覧'), ['action' => 'view', $center->id]) ?> </li>
        <li><?= $this->Form->postLink(
                __('削除'),
                ['action' => 'delete', $center->id],
                ['confirm' => __(DELETE_CONFIRM.' # {0}?', $center->id)]
            )
        ?></li>
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= TITLE_DEVICE ?></li>
        <li><?= $this->Html->link(__('一覧'), ['controller' => 'Devices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('登録'), ['controller' => 'Devices', 'action' => 'add', $center->id]) ?></li>
    </ul>
    <?php echo $this->element('navi_master'); ?>
</nav>
<div class="centers form large-9 medium-8 columns content">
    <?= $this->Form->create($center) ?>
    <fieldset>
        <legend><?= __('Edit Center') ?></legend>
        <?php
            echo $this->Form->control('m_customer_id', ['options' => $mCustomers]);
            echo $this->Form->control('name');
            echo $this->Form->control('postcode');
            echo $this->Form->control('m_prefecture_id', ['options' => $mPrefectures, 'empty' => true]);
            echo $this->Form->control('address');
            echo $this->Form->control('tel');
            echo $this->Form->control('officer');
            echo $this->Form->control('staff');
            echo $this->Form->control('access');
            echo $this->Form->control('job');
            echo $this->Form->control('remarks');
            echo $this->Form->control('thermo_dry_flag');
            echo $this->Form->control('thermo_chilled_flag');
            echo $this->Form->control('thermo_frozen_flag');
            echo $this->Form->control('shoes_flag');
            echo $this->Form->control('delete_flag');
            echo $this->Form->hidden('m_user_id', ['value' => $this->request->session()->read('Auth.User.id')]);

        ?>
    </fieldset>
    <?= $this->Form->button(__('更新')) ?>
    <?= $this->Form->end() ?>
</div>
