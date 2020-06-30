<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Center $center
 */
?>
<script type="text/javascript">
function delPhoto(filename, id)
{
   if(confirm('「' + filename + '」\r\nを削除します。よろしいですか？'))
   {
       window.location.href = '/center_info/centers/deletePhoto/<?= $center->id ?>/' + id;
   }
}
function delFile(filename, id)
{
   if(confirm('「' + filename + '」\r\nを削除します。よろしいですか？'))
   {
       window.location.href = '/center_info/centers/deleteFile/<?= $center->id ?>/' + id;
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
    <h3 style="float: left"><?= h($center->name) ?></h3>
    <div style="float: right">
        <?= $this->Form->button('編集', ['type' => 'button', 'class' => 'download_button', 'onclick' => "window.location.href = '/center_info/centers/edit/$center->id'"]) ?>
    </div>
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
        <h4><?= __('端末情報') ?></h4>
        <!--
        <?= $this->Form->button('CSVダウンロード', ['type' => 'button', 'class' => 'download_button', 'onclick' => "window.location.href = '/center_info/centers/getDevices/$center->id'"]) ?>
        <div style="float: right;">
            <?= $this->Form->button('CSV一括更新', ['type' => 'button', 'class' => 'download_button', 'onclick' => "openModal('Devices')"]) ?>
        </div>
        -->
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
                <th scope="col"><?= __('サポート終了') ?></th><!--
                <th scope="col"><?= __('接続先') ?></th>
                <th scope="col"><?= __('リモート') ?></th>-->
                <th scope="col" class="actions"><?= __('') ?></th>
            </tr>
            <?php foreach ($center->devices as $devices): ?>
            <tr class="clickable <?= $devices->delete_flag?'delete_content':'' ?>" data-href="<?= $this->Url->build(['controller' => 'Devices', 'action' => 'view', $devices->id]) ?>">
                <td><?= h($devices->name) ?></td>
                <td style="background-color: <?= h($device_color_list[$devices->m_device_type_id]) ?>;"><?= h($mDeviceTypes[$devices->m_device_type_id]) ?></td>
                <td><?= h($devices->accepted_no) ?></td>
                <td><?= h($devices->ip_higher) ?></td>
                <td><?= h($devices->ip_lower) ?></td>
                <td><?php if($devices->reserve_flag){ echo LIST_CHECK_MARK; } ?></td>
                <td><?= h($devices->setup_date) ?></td>
                <td><?= h($devices->support_end_date) ?></td><!--
                <td><?= h($devices->connect) ?></td>
                <td><?= h($devices->remote) ?></td>-->
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
    <div class="row">
        <h4><?= __('アクセス') ?></h4>
        <?= $this->Text->autoParagraph(h($center->access)); ?>
    </div>
    <div class="row">
        <h4><?= __('業務内容') ?></h4>
        <?= $this->Text->autoParagraph(h($center->job)); ?>
    </div>
    <div class="row">
        <h4><?= __('写真') ?></h4>
        <?= $this->Form->button('写真保存', ['type' => 'button', 'id' => 'openModal', 'class' => 'copy_button', 'onclick' => "openModal('Photo')"]) ?>
        <?php if (!empty($center->photos)): ?>
        <div class="photos">
        <?php foreach ($center->photos as $pho): ?>
            <div class='photo'>
                <?= $this->Html->link($this->Html->image($pho->file_path_thmb, array('alt'=>$pho->file_path)), $pho->file_path, ['target' => '_blank', 'escape' => false]) ?>
                <p><?= '&nbsp;'.$this->Form->button('削除', ['type' => 'button', 'class' => 'copy_button', 'onclick' => "delPhoto('".$pho->file_name."', '".$pho->id."')"]) ?>&nbsp;<?= $pho->file_name ?></p>
            </div>
        <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <h4><?= __('添付ファイル') ?></h4>
        <?= $this->Form->button('ファイル保存', ['type' => 'button', 'id' => 'openModal', 'class' => 'copy_button', 'onclick' => "openModal('File')"]) ?>
        <?php if (!empty($center->documents)): ?>
        <table class="">
            <tr>
                <th scope="col"><?= __('ファイル') ?></th>
                <th scope="col" class="th_short"><?= __('') ?></th>
            </tr>
        <?php foreach ($center->documents as $doc): ?>
            <tr>
                <td><?= $this->Form->postLink(__($doc->file_name), ['controller' => 'Centers', 'action' => 'download', $doc->id]) ?></td>
                <td><?= '&nbsp;'.$this->Form->button('削除', ['type' => 'button', 'class' => 'copy_button', 'onclick' => "delFile('".$doc->file_name."', '".$doc->id."')"]) ?></td>
            </tr>
        <?php endforeach; ?>            
        </table>
        <?php endif; ?>
    </div>
    <div class="row">
        <h4><?= __('備考') ?></h4>
        <?= $this->Text->autoParagraph(h($center->remarks)); ?>
    </div>
</div>
<!-- モーダルエリアここから -->
<section id="modalAreaPhoto" class="modal_area">
    <div class="modal_bg" onclick="closeModal('Photo')"></div>
    <div class="modal_wrapper">
        <div class="modal_contents">
            <?= $this->Form->create($center, ['action' => 'addPhoto/'.$center->id, 'enctype' => 'multipart/form-data']) ?>
            <?php 
                echo $this->Form->hidden('center_id', ['value' => $center->id]);
                echo $this->Form->hidden('device_id', ['value' => 0]);
                echo $this->Form->file('import_file');
                echo $this->Form->hidden('file_name', ['value' => '']);
                echo $this->Form->hidden('file_path', ['value' => '']);
                echo $this->Form->hidden('file_path_thmb', ['value' => '']);
                echo $this->Form->hidden('remarks', ['value' => '']);
                echo $this->Form->hidden('delete_flag', ['value' => 0]);
                echo $this->Form->hidden('m_user_id', ['value' => $this->request->session()->read('Auth.User.id')]);
            ?>
            <?= $this->Form->button(__('登録')) ?>
            <?= $this->Form->end() ?>
            ※ファイルサイズは10MB未満としてください
        </div>
        <div class="close_modal" onclick="closeModal('Photo')">
        ×
        </div>
    </div>
</section>
<section id="modalAreaFile" class="modal_area">
    <div class="modal_bg" onclick="closeModal('File')"></div>
    <div class="modal_wrapper">
        <div class="modal_contents">
            <?= $this->Form->create($center, ['action' => 'addFile/'.$center->id, 'enctype' => 'multipart/form-data']) ?>
            <?php 
                echo $this->Form->hidden('center_id', ['value' => $center->id]);
                echo $this->Form->hidden('device_id', ['value' => 0]);
                echo $this->Form->file('import_file');
                echo $this->Form->hidden('file_name', ['value' => '']);
                echo $this->Form->hidden('file_path', ['value' => '']);
                echo $this->Form->hidden('remarks', ['value' => '']);
                echo $this->Form->hidden('delete_flag', ['value' => 0]);
                echo $this->Form->hidden('m_user_id', ['value' => $this->request->session()->read('Auth.User.id')]);
            ?>
            <?= $this->Form->button(__('登録')) ?>
            <?= $this->Form->end() ?>
            ※ファイルサイズは10MB未満としてください
        </div>
        <div class="close_modal" onclick="closeModal('File')">
        ×
        </div>
    </div>
</section>
<section id="modalAreaDevices" class="modal_area">
    <div class="modal_bg" onclick="closeModal('Devices')"></div>
    <div class="modal_wrapper">
        <div class="modal_contents">
            <?= $this->Form->create($center, ['action' => 'uploadDevices/'.$center->id, 'enctype' => 'multipart/form-data']) ?>
            <?= $this->Form->file('import_file') ?>
            <?= $this->Form->button(__('登録')) ?>
            <?= $this->Form->end() ?>
            ※ファイルサイズは10MB未満としてください
        </div>
        <div class="close_modal" onclick="closeModal('Devices')">
        ×
        </div>
    </div>
</section>
<!-- モーダルエリアここまで -->