<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device $device
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= TITLE_CENTER ?></li>
        <li><?= $this->Html->link(__('一覧'), ['controller' => 'Centers', 'action' => 'index']) ?> </li>
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= TITLE_DEVICE ?></li>
        <li><?= $this->Html->link(__('一覧'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('登録'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('閲覧'), ['action' => 'view', $device->id]) ?> </li>
        <?php if($this->request->session()->read('Auth.User.m_role_id') == ROLE_ID_ADMIN){ ?>
        <li><?= $this->Form->postLink(
                __('削除'),
                ['action' => 'delete', $device->id],
                ['confirm' => __(DELETE_CONFIRM.' # {0}?', $device->id)]
            )
        ?></li>
        <?php } ?>
    </ul>
    <?php echo $this->element('navi_master'); ?>
</nav>
<div class="devices form large-9 medium-8 columns content">
    <?= $this->Form->create($device) ?>
    <fieldset>
        <legend><?= __('端末情報') ?></legend>
        <h4><?= $centers->toArray()[$device->toArray()['center_id']]; ?></h4>
        <?php
            echo $this->Form->hidden('center_id');
            echo $this->Form->control('accepted_no', ['label' => '受入No']);
            echo $this->Form->control('m_device_type_id', ['options' => $mDeviceTypes, 'label' => '端末種別']);
            echo $this->Form->control('name', ['label' => '端末名']);
            echo $this->Form->control('model', ['label' => '型式']);
            echo $this->Form->control('serial_no', ['label' => '製造番号']);
            echo $this->Form->control('ip_higher', ['label' => '上位IP']);
            echo $this->Form->control('ip_lower', ['label' => '下位IP']);
            echo $this->Form->control('setup_date', ['dateFormat' => 'YMD', 'monthNames' => false, 'maxYear' => date('Y') + 5, 'minYear' => date('Y') - 10, 'empty' => true, 'label' => '設置日']);
            echo $this->Form->control('support_end_date', ['dateFormat' => 'YMD', 'monthNames' => false, 'maxYear' => date('Y') + 5, 'minYear' => date('Y') - 10, 'empty' => true, 'label' => 'サポート終了日']);
            echo $this->Form->control('reserve_flag', ['label' => '予備']);
            echo $this->Form->control('m_operation_system_id', ['options' => $mOperationSystems, 'empty' => true, 'label' => 'OS種別']);
            echo $this->Form->control('m_sqlserver_id', ['options' => $mSqlservers, 'empty' => true, 'label' => 'SQLServer種別']);
            echo $this->Form->control('admin_pass', ['label' => 'AdminPass']);
            echo $this->Form->control('m_product_id', ['options' => $mProducts, 'empty' => true, 'label' => '製造']);
            echo $this->Form->control('m_version_id', ['options' => $mVersions, 'empty' => true, 'label' => 'Appバージョン']);
            echo $this->Form->control('connect', ['label' => '接続先']);
            echo $this->Form->control('remote', ['label' => 'リモート']);
            echo $this->Form->control('running_flag', ['label' => '稼働中']);
            echo $this->Form->control('security_flag', ['label' => 'セキュリティソフト']);
            echo $this->Form->control('custom', ['label' => '改造内容']);
            echo $this->Form->control('remarks', ['label' => '備考']);
            echo $this->Form->control('delete_flag', ['label' => '削除']);
            echo $this->Form->hidden('m_user_id', ['value' => $this->request->session()->read('Auth.User.id')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('更新')) ?>
    <?= $this->Form->end() ?>
</div>
