<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device $device
 */
?>
<script type="text/javascript">
function del_file(filename)
{
   if(confirm('「' + filename + '」\r\nを削除します。よろしいですか？'))
   {
       window.location.href = '/center_info/devices/deleteFile/<?= $device->id ?>/' + encodeURI(filename);
   }
}
</script>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= TITLE_CENTER ?></li>
        <li><?= $this->Html->link(__('一覧'), ['controller' => 'Centers', 'action' => 'index']) ?> </li>
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= TITLE_DEVICE ?></li>
        <li><?= $this->Html->link(__('一覧'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('登録'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('編集'), ['action' => 'edit', $device->id]) ?> </li><!--
        <li><?= $this->Form->postLink(__('削除'), ['action' => 'delete', $device->id], ['confirm' => __(DELETE_CONFIRM.' # {0}?', $device->id)]) ?> </li>-->
    </ul>
    <?php echo $this->element('navi_master'); ?>
</nav>
<div class="devices view large-9 medium-8 columns content">
    <h3><?= h($device->name) ?></h3>
    <table class="">
        <tr>
            <th scope="row"><?= __('拠点') ?></th>
            <td colspan="5"><?= $device->has('center') ? $this->Html->link($device->center->name, ['controller' => 'Centers', 'action' => 'view', $device->center->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('受入No') ?></th>
            <td><?= h($device->accepted_no) ?></td>
            <th scope="row"><?= __('端末種別') ?></th>
            <td colspan="3"><?= $device->has('m_device_type') ? $device->m_device_type->name : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('端末名') ?></th>
            <td><?= h($device->name) ?></td>
            <th scope="row"><?= __('型式') ?></th>
            <td><?= h($device->model) ?></td>
            <th scope="row"><?= __('製造番号') ?></th>
            <td><?= h($device->serial_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('上位IP') ?></th>
            <td><?= h($device->ip_higher) ?><?php if(!empty($device->ip_higher)){
                echo '&nbsp;';
                echo $this->Form->button('COPY', ['type' => 'button', 'class' => 'copy_button', 'onclick' => 'clipboard_copy(\''.$device->ip_higher.'\');']);
            } ?></td>
            <th scope="row"><?= __('下位IP') ?></th>
            <td><?= h($device->ip_lower) ?><?php if(!empty($device->ip_lower)){
                echo '&nbsp;';
                echo $this->Form->button('COPY', ['type' => 'button', 'class' => 'copy_button', 'onclick' => 'clipboard_copy(\''.$device->ip_lower.'\');']);
            } ?></td>
            <th scope="row"><?= __('AdminPass') ?></th>
            <td><?= h($device->admin_pass) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('設置日') ?></th>
            <td><?= h($device->setup_date) ?></td>
            <th scope="row"><?= __('サポート終了日') ?></th>
            <td colspan="3"><?= h($device->support_end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('予備') ?></th>
            <td><?= $device->reserve_flag ? __(LIST_CHECK_MARK) : __(''); ?></td>
        <!--
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($device->id) ?></td>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($device->created) ?></td>
        -->
            <th scope="row"><?= __('稼働中') ?></th>
            <td><?= $device->running_flag ? __(LIST_CHECK_MARK) : __(''); ?></td>
            <th scope="row"><?= __('セキュリティソフト') ?></th>
            <td><?= $device->security_flag ? __(LIST_CHECK_MARK) : __(''); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('OS種別') ?></th>
            <td><?= $device->has('m_operation_system') ? $device->m_operation_system->name : '' ?></td>
            <th scope="row"><?= __('SQLServer種別') ?></th>
            <td><?= $device->has('m_sqlserver') ? $device->m_sqlserver->name : '' ?></td>
            <th scope="row"><?= __('接続先') ?></th>
            <td><?= h($device->connect) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('製造') ?></th>
            <td><?= $device->has('m_product') ? $device->m_product->name : '' ?></td>
            <th scope="row"><?= __('Appバージョン') ?></th>
            <td><?= $device->has('m_version') ? $device->m_version->name : '' ?></td>
            <th scope="row"><?= __('リモート') ?></th>
            <td><?= h($device->remote) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('最終更新日時') ?></th>
            <td><?= h($device->modified) ?></td>
            <th scope="row"><?= __('最終更新者') ?></th>
            <td><?= $device->has('m_user') ? $device->m_user->name : '' ?></td>
            <th scope="row"><?= __('削除') ?></th>
            <td><?= $device->delete_flag ? __(LIST_CHECK_MARK) : __(''); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('改造内容') ?></h4>
        <?= $this->Text->autoParagraph(h($device->custom)); ?>
    </div>
    <div class="row">
        <h4><?= __('備考') ?></h4>
        <?= $this->Text->autoParagraph(h($device->remarks)); ?>
    </div>
    <div class="row">
        <h4><?= __('添付ファイル') ?></h4>
        <ul>
        <?php foreach ($file_list as $key => $val): ?>
            <li><?= $this->Html->link(__($key), $val, ['target' => '_blank']) ?><?= '&nbsp;'.$this->Form->button('DELETE', ['type' => 'button', 'class' => 'copy_button', 'onclick' => "del_file('".$key."')"]) ?></li>
        <?php endforeach; ?>            
        </ul>
        <?= $this->Form->create($device, ['action' => 'addFile/'.$device->id, 'enctype' => 'multipart/form-data']) ?>
        <?= $this->Form->file('import_file') ?>
        <?= $this->Form->button(__('UPLOAD')) ?>
        <?= $this->Form->end() ?>
    </div>
    <div class="related">
        <h4><?= __('コメント') ?></h4>
        <?php if (!empty($device->comments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('コメント') ?></th>
                <th scope="col"><?= __('削除') ?></th>
                <th scope="col"><?= __('ユーザー') ?></th>
                <th scope="col"><?= __('作成日時') ?></th>
                <th scope="col"><?= __('更新日時') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
            </tr>
            <?php foreach ($device->comments as $comments): ?>
            <tr>
                <td><?= h($comments->content) ?></td>
                <td><?= h($comments->delete_flag) ?></td>
                <td><?= h($comments->m_user_id) ?></td>
                <td><?= h($comments->created) ?></td>
                <td><?= h($comments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('閲覧'), ['controller' => 'Comments', 'action' => 'view', $comments->id]) ?>
                    /
                    <?= $this->Html->link(__('編集'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('改造履歴') ?></h4>
        <?php if (!empty($device->customs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('受入No') ?></th>
                <th scope="col"><?= __('内容') ?></th>
                <th scope="col"><?= __('削除') ?></th>
                <th scope="col"><?= __('ユーザー') ?></th>
                <th scope="col"><?= __('作成日時') ?></th>
                <th scope="col"><?= __('更新日時') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
            </tr>
            <?php foreach ($device->customs as $customs): ?>
            <tr>
                <td><?= h($customs->accepted_no) ?></td>
                <td><?= h($customs->content) ?></td>
                <td><?= h($customs->delete_flag) ?></td>
                <td><?= h($customs->m_user_id) ?></td>
                <td><?= h($customs->created) ?></td>
                <td><?= h($customs->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('閲覧'), ['controller' => 'Customs', 'action' => 'view', $customs->id]) ?>
                    /
                    <?= $this->Html->link(__('編集'), ['controller' => 'Customs', 'action' => 'edit', $customs->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
