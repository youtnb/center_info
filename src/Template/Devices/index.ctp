<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device[]|\Cake\Collection\CollectionInterface $devices
 */
?>
<script type="text/javascript">
jQuery(function($)
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
    <?= $this->Form->create(null, ['type' => 'get']) ?>
        <fieldset class="search_form">
            <table>
                <tr>
                    <td><?= $this->Form->input('m_customer_id', ['type' => 'select' ,'options' => $mCustomers, 'empty' => '選択してください', 'label' => '顧客', 'value' => $this->request->query('m_customer_id')]) ?></td>
                    <td><?= $this->Form->input('m_area_id', ['type' => 'select' ,'options' => $mAreas, 'empty' => '選択してください', 'label' => '地域', 'value' => $this->request->query('m_area_id')]) ?></td>
                    <td><?= $this->Form->input('m_prefecture_id', ['type' => 'select' ,'options' => $mPrefectures, 'empty' => '選択してください', 'label' => '都道府県', 'value' => $this->request->query('m_prefecture_id')]) ?></td>
                    <td><?= $this->Form->input('name', ['type' => 'text' , 'label' => '拠点名', 'value' => $this->request->query('name')]) ?></td>
                    <td rowspan="3" style="vertical-align: middle; text-align: center"><?= $this->Form->button('検索') ?>&nbsp;<?= $this->Form->button('クリア', ['type' => 'button', 'onclick' => "resetForm('devices/clear');"]) ?></td>
                </tr>
                <tr>
                    <td><?= $this->Form->input('m_device_type_id', ['type' => 'select' ,'options' => $mDeviceTypes, 'empty' => '選択してください', 'label' => '端末種別', 'value' => $this->request->query('m_device_type_id')]) ?></td>
                    <td><?= $this->Form->input('m_operation_system_id', ['type' => 'select' ,'options' => $mOperationSystems, 'empty' => '選択してください', 'label' => 'OS種別', 'value' => $this->request->query('m_operation_system_id')]) ?></td>
                    <td><?= $this->Form->input('security_flag', ['type' => 'select' ,'options' => $sec_flag, 'empty' => '選択してください', 'label' => 'セキュリティソフト', 'value' => $this->request->query('security_flag')]) ?></td>
                    <td><?= $this->Form->input('model', ['type' => 'text' , 'label' => '型式', 'value' => $this->request->query('model')]) ?></td>
                </tr>
                <tr>
                    <td><?= $this->Form->input('setup_date', ['type' => 'text' , 'label' => '設置日', 'value' => $this->request->query('setup_date')]) ?></td>
                    <td><?= $this->Form->input('support_end_date', ['type' => 'text' , 'label' => '保守期限日', 'value' => $this->request->query('support_end_date')]) ?></td>
                    <td></td>
                    <td style="vertical-align: middle;"><?= $this->Form->input('delete_flag', ['type' => 'checkbox' , 'label' => '削除済みも表示する', 'checked' => $this->request->query('delete_flag')?'checked':'']) ?></td>
                </tr>
                <tr>
                    <td colspan="5">※日付はyyyyMMdd形式で指定、ハイフンで範囲指定可能（例.yyyyMMdd-yyyyMMdd、片側のみ可）<br />※顧客・地域・都道府県・拠点名の指定は、拠点情報一覧と共通です</td>
                </tr>
            </table>
        </fieldset>
    <?= $this->Form->end() ?>
    <div style='float: right;'>
        <div style='float: left; margin-right: 5px;'>
        <?= $this->Form->create(null, ['type' => 'post', 'url' => '/devices/output/']) ?>
            <?php
                echo $this->Form->hidden('m_customer_id', ['value' => $this->request->query('m_customer_id')]);
                echo $this->Form->hidden('m_area_id', ['value' => $this->request->query('m_area_id')]);
                echo $this->Form->hidden('m_prefecture_id', ['value' => $this->request->query('m_prefecture_id')]);
                echo $this->Form->hidden('center_id', ['value' => $this->request->query('center_id')]);
                echo $this->Form->hidden('m_device_type_id', ['value' => $this->request->query('m_device_type_id')]);
                echo $this->Form->hidden('m_operation_system_id', ['value' => $this->request->query('m_operation_system_id')]);
                echo $this->Form->hidden('name', ['value' => $this->request->query('name')]);
            ?>
            <?= $this->Form->button(__('CSV ダウンロード'), ['class' => 'download_button']) ?>
        <?= $this->Form->end() ?>
        </div>
        <div style='float: left;'>
        <?= $this->Form->create(null, ['type' => 'post', 'url' => '/devices/outputExcel/']) ?>
            <?php
                echo $this->Form->hidden('m_customer_id', ['value' => $this->request->query('m_customer_id')]);
                echo $this->Form->hidden('m_area_id', ['value' => $this->request->query('m_area_id')]);
                echo $this->Form->hidden('m_prefecture_id', ['value' => $this->request->query('m_prefecture_id')]);
                echo $this->Form->hidden('center_id', ['value' => $this->request->query('center_id')]);
                echo $this->Form->hidden('m_device_type_id', ['value' => $this->request->query('m_device_type_id')]);
                echo $this->Form->hidden('m_operation_system_id', ['value' => $this->request->query('m_operation_system_id')]);
                echo $this->Form->hidden('name', ['value' => $this->request->query('name')]);
            ?>
            <?= $this->Form->button(__('EXCEL ダウンロード'), ['class' => 'download_button']) ?>
        <?= $this->Form->end() ?>
        </div>
    </div>
    <div style='clear: both;'></div>
    <div class="list_table">
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" class="th_customer"><?= __('顧客') ?></th>
                <th scope="col" class="th_center"><?= $this->Paginator->sort('center_id', '拠点') ?></th>
                <th scope="col" class="th_short"><?= $this->Paginator->sort('m_device_type_id', '端末種別') ?></th>
                <!--
                <th scope="col" class="th_short"><?= $this->Paginator->sort('accepted_no', '受入No') ?></th>
                -->
                <th scope="col" class="th_short"><?= $this->Paginator->sort('name', '端末名') ?></th>
                <th scope="col" class="th_short_20"><?= $this->Paginator->sort('ip_higher', '上位IP') ?></th>
                <th scope="col" class="th_short_20"><?= $this->Paginator->sort('ip_lower', '下位IP') ?></th>
                <th scope="col" class="th_flag"><?= $this->Paginator->sort('reserve_flag', '予備') ?></th>
                <th scope="col" class="th_flag"><?= $this->Paginator->sort('security_flag', 'McA') ?></th>
                <th scope="col" class="th_ymd"><?= $this->Paginator->sort('setup_date', '設置日') ?></th>
                <th scope="col" class="th_ymd"><?= $this->Paginator->sort('support_end_date', '保守終了日') ?></th>
                <!--
                <th scope="col"><?= $this->Paginator->sort('m_version_id', 'バージョン') ?></th>
                <th scope="col"><?= $this->Paginator->sort('connect', '接続先') ?></th>
                <th scope="col"><?= $this->Paginator->sort('remote', 'リモート') ?></th>
                <th scope="col"><?= $this->Paginator->sort('running_flag', '稼働') ?></th>
                <th scope="col" class="th_flag"><?= $this->Paginator->sort('delete_flag', '削除') ?></th>
                -->
                <th scope="col" class="actions th_actions"><?= __('') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($devices as $device): ?>
            <tr class="clickable <?= $device->delete_flag?'delete_content':'' ?>" data-href="<?= $this->Url->build(['controller' => 'Devices', 'action' => 'view', $device->id]) ?>">
                <td><?= $mCustomers->toArray()[$device->toArray()['center']['m_customer_id']] ?></td>
                <td><?= $device->has('center') ? $device->center->name : '' ?></td>
                <!--<td style="background-color: <?= h($device->m_device_type->background_color) ?>;"><?= $device->has('m_device_type') ? $this->Html->link($device->m_device_type->name, ['controller' => 'MDeviceTypes', 'action' => 'view', $device->m_device_type->id]) : '' ?></td>-->
                <td style="background-color: <?= h($device->m_device_type->background_color) ?>;"><?= h($device->m_device_type->name) ?></td>
                <!--<td><?= h($device->accepted_no) ?></td>-->
                <td><?= h($device->name) ?></td>
                <td><?= h($device->ip_higher) ?></td>
                <td><?= h($device->ip_lower) ?></td>
                <td style="text-align: center"><?php if($device->reserve_flag){ echo LIST_CHECK_MARK; } ?></td>
                <td style="text-align: center"><?= !empty($device->security_flag) ? $sec_flag[$device->security_flag] : '' ?></td>
                <td><?= h($device->setup_date) ?></td>
                <td><?= h($device->support_end_date) ?></td>
                <!--
                <td><?= $device->has('m_version') ? $this->Html->link($device->m_version->name, ['controller' => 'MVersions', 'action' => 'view', $device->m_version->id]) : '' ?></td>
                <td><?= h($device->connect) ?></td>
                <td><?= h($device->remote) ?></td>
                <td><?= h($device->running_flag) ?></td>
                <td style="text-align: center"><?php if($device->delete_flag){ echo LIST_CHECK_MARK; } ?></td>
                -->
                <td class="actions">
                    <!--<?= $this->Html->link(__('閲覧'), ['action' => 'view', $device->id]) ?>
                    /
                    --><?= $this->Html->link(__('編集'), ['action' => 'edit', $device->id]) ?><!--
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
