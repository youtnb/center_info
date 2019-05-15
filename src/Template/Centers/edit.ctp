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
        <?php if($this->request->session()->read('Auth.User.m_role_id') == ROLE_ID_ADMIN){ ?>
        <li><?= $this->Form->postLink(
                __('削除'),
                ['action' => 'delete', $center->id],
                ['confirm' => __(DELETE_CONFIRM.' # {0}?', $center->id)]
            )
        ?></li>
        <?php } ?>
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
        <legend><?= __('拠点情報') ?></legend>
        <?php
            echo $this->Form->control('m_customer_id', ['options' => $mCustomers, 'label' => '顧客']);
            echo $this->Form->control('name', ['label' => '拠点名']);
            echo $this->Form->control('postcode', ['label' => '郵便番号']);
            echo $this->Form->control('m_prefecture_id', ['options' => $mPrefectures, 'empty' => true, 'label' => '都道府県']);
            echo $this->Form->control('address', ['label' => '住所']);
            echo $this->Form->control('tel', ['label' => '電話番号']);
            echo $this->Form->control('officer', ['label' => '責任者']);
            echo $this->Form->control('staff', ['label' => '担当者']);
            echo $this->Form->control('access', ['label' => 'アクセス']);
            echo $this->Form->control('job', ['label' => '業務内容']);
            echo $this->Form->control('remarks', ['label' => '備考']);
            echo $this->Form->control('thermo_dry_flag', ['label' => '温度帯【ドライ】']);
            echo $this->Form->control('thermo_chilled_flag', ['label' => '温度帯【チルド】']);
            echo $this->Form->control('thermo_frozen_flag', ['label' => '温度帯【フローズン】']);
            echo $this->Form->control('shoes_flag', ['label' => '要上履き']);
            echo $this->Form->control('delete_flag', ['label' => '削除']);
            echo $this->Form->hidden('m_user_id', ['value' => $this->request->session()->read('Auth.User.id')]);

        ?>
    </fieldset>
    <?= $this->Form->button(__('更新')) ?>
    <?= $this->Form->end() ?>
</div>
