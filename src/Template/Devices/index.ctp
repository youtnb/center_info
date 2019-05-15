<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device[]|\Cake\Collection\CollectionInterface $devices
 */
?>
<script type="text/javascript">
$(document).ready(function()
{
    // 顧客選択時、拠点選択クリア
    $('#m-customer-id').change(function()
    {
        $('#center-id').val('');
    });
    // 地域選択時、都道府県選択クリアand拠点選択クリア
    $('#m-area-id').change(function()
    {
        $('#m-prefecture-id').val('');
        $('#center-id').val('');
    });
    // 都道府県選択時、拠点選択クリア
    $('#m-prefecture-id').change(function()
    {
        $('#center-id').val('');
    });
});
</script>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= TITLE_CENTER ?></li>
        <li><?= $this->Html->link(__('一覧'), ['controller' => 'Centers', 'action' => 'index']) ?> </li>
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= TITLE_DEVICE ?></li>
        <li><?= $this->Html->link(__('登録'), ['action' => 'add']) ?></li>
    </ul>
    <?php echo $this->element('navi_master'); ?>
</nav>
<div class="devices index large-9 medium-8 columns content">
    <h3><?= __('端末情報一覧') ?></h3>
    <?= $this->Form->create() ?>
        <fieldset class="search_form">
            <table>
                <tr>
                    <td><?= $this->Form->input('m_customer_id', ['type' => 'select' ,'options' => $mCustomers, 'empty' => '選択してください', 'label' => '顧客']) ?></td>
                    <td><?= $this->Form->input('m_area_id', ['type' => 'select' ,'options' => $mAreas, 'empty' => '選択してください', 'label' => '地域']) ?></td>
                    <td><?= $this->Form->input('m_prefecture_id', ['type' => 'select' ,'options' => $mPrefectures, 'empty' => '選択してください', 'label' => '都道府県']) ?></td>
                    <td><?= $this->Form->input('center_id', ['type' => 'select' ,'options' => $centers, 'empty' => '選択してください', 'label' => '拠点']) ?></td>
                    <td rowspan="2" style="vertical-align: middle; text-align: center"><?= $this->Form->button('検索') ?>&nbsp;<?= $this->Form->button('クリア', ['type' => 'button', 'onclick' => 'reset_form();']) ?></td>
                </tr>
                <tr>
                    <td><?= $this->Form->input('m_device_type_id', ['type' => 'select' ,'options' => $mDeviceTypes, 'empty' => '選択してください', 'label' => '端末種別']) ?></td>
                    <td><?= $this->Form->input('m_operation_system_id', ['type' => 'select' ,'options' => $mOperationSystems, 'empty' => '選択してください', 'label' => 'OS種別']) ?></td>
                    <td><?= $this->Form->input('name', ['type' => 'text' , 'label' => '端末名']) ?></td>
                    <td style="vertical-align: middle;"><?= $this->Form->input('delete_flag', ['type' => 'checkbox' , 'label' => '削除済みも表示する']) ?></td>
                </tr>
            </table>
        </fieldset>
    <?= $this->Form->end() ?>
    <div class="list_table">
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" class="th_customer"><?= __('顧客') ?></th>
                <th scope="col" class="th_center"><?= $this->Paginator->sort('center_id', '拠点') ?></th>
                <th scope="col" class="th_short"><?= $this->Paginator->sort('m_device_type_id', '端末種別') ?></th>
                <th scope="col" class="th_short"><?= $this->Paginator->sort('accepted_no', '受入No') ?></th>
                <th scope="col" class="th_short"><?= $this->Paginator->sort('name', '端末名') ?></th>
                <th scope="col" class="th_short_20"><?= $this->Paginator->sort('ip_higher', '上位IP') ?></th>
                <th scope="col" class="th_short_20"><?= $this->Paginator->sort('ip_lower', '下位IP') ?></th>
                <th scope="col" class="th_flag"><?= $this->Paginator->sort('reserve_flag', '予備') ?></th>
                <!--
                <th scope="col"><?= $this->Paginator->sort('security_flag', 'セキュリティ') ?></th>
                <th scope="col"><?= $this->Paginator->sort('support_end_date', '保守終了日') ?></th>
                -->
                <th scope="col" class="th_ymd"><?= $this->Paginator->sort('setup_date', '設置日') ?></th>
                <!--
                <th scope="col"><?= $this->Paginator->sort('m_version_id', 'バージョン') ?></th>
                <th scope="col"><?= $this->Paginator->sort('connect', '接続先') ?></th>
                <th scope="col"><?= $this->Paginator->sort('remote', 'リモート') ?></th>
                <th scope="col"><?= $this->Paginator->sort('running_flag', '稼働') ?></th>
                -->
                <th scope="col" class="th_flag"><?= $this->Paginator->sort('delete_flag', '削除') ?></th>
                <th scope="col" class="actions th_actions"><?= __('') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($devices as $device): ?>
            <tr<?= $device->delete_flag?' class="delete_content"':'' ?>>
                <td><?= $mCustomers->toArray()[$device->toArray()['center']['m_customer_id']] ?></td>
                <td><?= $device->has('center') ? $this->Html->link($device->center->name, ['controller' => 'Centers', 'action' => 'view', $device->center->id]) : '' ?></td>
                <!--<td style="background-color: <?= h($device->m_device_type->background_color) ?>;"><?= $device->has('m_device_type') ? $this->Html->link($device->m_device_type->name, ['controller' => 'MDeviceTypes', 'action' => 'view', $device->m_device_type->id]) : '' ?></td>-->
                <td style="background-color: <?= h($device->m_device_type->background_color) ?>;"><?= h($device->m_device_type->name) ?></td>
                <td><?= h($device->accepted_no) ?></td>
                <td><?= h($device->name) ?></td>
                <td><?= h($device->ip_higher) ?></td>
                <td><?= h($device->ip_lower) ?></td>
                <td style="text-align: center"><?php if($device->reserve_flag){ echo LIST_CHECK_MARK; } ?></td>
                <!--
                <td style="text-align: center"><?php if($device->security_flag){ echo LIST_CHECK_MARK; } ?></td>
                <td><?= h($device->support_end_date) ?></td>
                -->
                <td><?= h($device->setup_date) ?></td>
                <!--
                <td><?= $device->has('m_version') ? $this->Html->link($device->m_version->name, ['controller' => 'MVersions', 'action' => 'view', $device->m_version->id]) : '' ?></td>
                <td><?= h($device->connect) ?></td>
                <td><?= h($device->remote) ?></td>
                <td><?= h($device->running_flag) ?></td>
                -->
                <td style="text-align: center"><?php if($device->delete_flag){ echo LIST_CHECK_MARK; } ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('閲覧'), ['action' => 'view', $device->id]) ?>
                    /
                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $device->id]) ?><!--
                    /
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $device->id], ['confirm' => __(DELETE_CONFIRM.' # {0}?', $device->id)]) ?>-->
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
