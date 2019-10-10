<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Center $center
 */
?>
<script type="text/javascript">
function del_file(filename)
{
   if(confirm('「' + filename + '」\r\nを削除します。よろしいですか？'))
   {
       window.location.href = '/center_info/centers/deleteFile/<?= $center->id ?>/' + encodeURI(filename);
   }
}
</script>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= TITLE_CENTER ?></li>
        <li><?= $this->Html->link(__('一覧'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('登録'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('編集'), ['action' => 'edit', $center->id]) ?> </li><!--
        <li><?= $this->Form->postLink(__('削除'), ['action' => 'delete', $center->id], ['confirm' => __(DELETE_CONFIRM.' # {0}?', $center->id)]) ?> </li>-->
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= TITLE_DEVICE ?></li>
        <li><?= $this->Html->link(__('一覧'), ['controller' => 'Devices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('登録'), ['controller' => 'Devices', 'action' => 'add', $center->id]) ?></li>
    </ul>
    <?php echo $this->element('navi_master'); ?>
</nav>
<div class="centers view large-9 medium-8 columns content">
    <h3><?= h($center->name) ?></h3>
    <table class="">
        <tr>
            <th scope="row"><?= __('顧客') ?></th>
            <td colspan="3"><?= h($center->m_customer->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('住所') ?></th>
            <td colspan="3"><?php
                echo $center->postcode ? '〒'. substr($center->postcode, 0, 3). ' - '. substr($center->postcode, 3). '&nbsp;': '';
                echo $center->has('m_prefecture') ? $center->m_prefecture->name : '';
                echo h($center->address);
            ?>
        </tr>
        <tr>
            <th scope="row"><?= __('電話番号') ?></th>
            <td><?= h($center->tel) ?></td>
            <th scope="row"><?= __('要上履き') ?></th>
            <td><?= $center->shoes_flag ? __(LIST_CHECK_MARK) : __(''); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('温度帯') ?></th>
            <td colspan="3"><?= $this->Display->thermo_list($center); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('責任者') ?></th>
            <td><?= h($center->officer) ?></td>
            <th scope="row"><?= __('担当者') ?></th>
            <td><?= h($center->staff) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('最終更新日時') ?></th>
            <td><?= h($center->modified) ?></td>
            <th scope="row"><?= __('最終更新者') ?></th>
            <td><?= h($center->m_user->name) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('アクセス') ?></h4>
        <?= $this->Text->autoParagraph(h($center->access)); ?>
    </div>
    <div class="row">
        <h4><?= __('業務内容') ?></h4>
        <?= $this->Text->autoParagraph(h($center->job)); ?>
    </div>
    <div class="row">
        <h4><?= __('備考') ?></h4>
        <?= $this->Text->autoParagraph(h($center->remarks)); ?>
    </div>
    <div class="row">
        <h4><?= __('添付ファイル') ?></h4>
        <ul>
        <?php foreach ($file_list as $key => $val): ?>
            <li><?= $this->Html->link(__($key), $val) ?><?= '&nbsp;'.$this->Form->button('DEL', ['type' => 'button', 'class' => 'copy_button', 'onclick' => "del_file('".$key."')"]) ?></li>
        <?php endforeach; ?>
        </ul>
        <?= $this->Form->create($center, ['action' => 'addFile/'.$center->id, 'enctype' => 'multipart/form-data']) ?>
        <?= $this->Form->file('import_file', ['label' => '仕様書']) ?>
        <?= $this->Form->button(__('保存')) ?>
        <?= $this->Form->end() ?>
    </div>
    <div class="related">
        <h4><?= __('端末情報') ?></h4>
        <?php if (!empty($center->devices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('端末名') ?></th>
                <th scope="col"><?= __('端末種別') ?></th>
                <th scope="col"><?= __('受入No') ?></th>
                <th scope="col"><?= __('上位IP') ?></th>
                <th scope="col"><?= __('下位IP') ?></th>
                <th scope="col"><?= __('予備') ?></th>
                <th scope="col"><?= __('設置日') ?></th>
                <th scope="col"><?= __('接続先') ?></th>
                <th scope="col"><?= __('リモート') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
            </tr>
            <?php foreach ($center->devices as $devices): ?>
            <tr class="clickable <?= $devices->delete_flag?'delete_content':'' ?>" data-href="<?= $this->Url->build(['controller' => 'Devices', 'action' => 'view', $devices->id]) ?>">
                <td><?= h($devices->name) ?></td>
                <td><?= h($mDeviceTypes[$devices->m_device_type_id]) ?></td>
                <td><?= h($devices->accepted_no) ?></td>
                <td><?= h($devices->ip_higher) ?></td>
                <td><?= h($devices->ip_lower) ?></td>
                <td><?= h($devices->reserve_flag) ?></td>
                <td><?= h($devices->setup_date) ?></td>
                <td><?= h($devices->connect) ?></td>
                <td><?= h($devices->remote) ?></td>
                <td class="actions">
                    <!-- <?= $this->Html->link(__('閲覧'), ['controller' => 'Devices', 'action' => 'view', $devices->id]) ?>
                    /
                    --><?= $this->Html->link(__('編集'), ['controller' => 'Devices', 'action' => 'edit', $devices->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
