<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device $device
 */
?>
<script type="text/javascript">
$(document).ready(function()
{
    var dropZonePhoto = document.getElementById('drop-zone-photo');
    var dropZoneFile = document.getElementById('drop-zone-file');
    
    dropZonePhoto.addEventListener('dragover', function(e) {
        e.stopPropagation();
        e.preventDefault();
        this.style.background = '#d1e7f0';
    }, false);
    dropZonePhoto.addEventListener('dragleave', function(e) {
        e.stopPropagation();
        e.preventDefault();
        this.style.background = '#ffffff';
    }, false);
    dropZonePhoto.addEventListener('drop', function(e) {
        e.stopPropagation();
        e.preventDefault();
        this.style.background = '#ffffff';
        
        let files = e.dataTransfer.files;
        if (files.length > 1) return alert('複数ファイルは同時に登録できません。');
        let fd = new FormData($('#addPhotoForm').get(0));
        fd.append('import_file', files[0]);

        let csrf = $('input[name=_csrfToken]').val();
        
        $.ajax({
            url: '/center_info/devices/addPhotoAjax/<?= $device->id; ?>',
            type: 'post',
            data: fd,
            dataType: 'text',
            processData: false,
            contentType: false,
            beforeSend: function(xhr){
                    $('.loading').removeClass('hide');
                    xhr.setRequestHeader("X-CSRF-Token",csrf);
                },
            success : function(res){
                    window.location.href = './<?= $device->id; ?>';
                },
            error : function(){
                    alert("登録エラーになりました。管理者にご確認ください。");
                }
        });
    }, false);
    
     dropZoneFile.addEventListener('dragover', function(e) {
        e.stopPropagation();
        e.preventDefault();
        this.style.background = '#d1e7f0';
    }, false);
    dropZoneFile.addEventListener('dragleave', function(e) {
        e.stopPropagation();
        e.preventDefault();
        this.style.background = '#ffffff';
    }, false);
    dropZoneFile.addEventListener('drop', function(e) {
        e.stopPropagation();
        e.preventDefault();
        this.style.background = '#ffffff';
        
        let files = e.dataTransfer.files;
        if (files.length > 1) return alert('複数ファイルは同時に登録できません。');
        let fd = new FormData($('#addFileForm').get(0));
        fd.append('import_file', files[0]);

        let csrf = $('input[name=_csrfToken]').val();
        
        $.ajax({
            url: '/center_info/devices/addFileAjax/<?= $device->id; ?>',
            type: 'post',
            data: fd,
            dataType: 'text',
            processData: false,
            contentType: false,
            beforeSend: function(xhr){
                    $('.loading').removeClass('hide');
                    xhr.setRequestHeader("X-CSRF-Token",csrf);
                },
            success : function(res){
                    window.location.href = './<?= $device->id; ?>';
                },
            error : function(){
                    alert("登録エラーになりました。管理者にご確認ください。");
                }
        });
    }, false);
});

function delPhoto(filename, id)
{
   if(confirm('「' + filename + '」\r\nを削除します。よろしいですか？'))
   {
       window.location.href = '/center_info/devices/deletePhoto/<?= $device->id ?>/' + id;
   }
}
function delFile(filename, id)
{
   if(confirm('「' + filename + '」\r\nを削除します。よろしいですか？'))
   {
       window.location.href = '/center_info/devices/deleteFile/<?= $device->id ?>/' + id;
   }
}
function delCustom(id)
{
   if(confirm('改造履歴を削除します。よろしいですか？'))
   {
       window.location.href = '/center_info/customs/deleteLogical/' + id + '/<?= $device->id ?>';
   }
}
function delComment(id)
{
   if(confirm('コメントを削除します。よろしいですか？'))
   {
       window.location.href = '/center_info/comments/deleteLogical/' + id + '/<?= $device->id ?>';
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
        <?php if($this->request->session()->read('Auth.User.m_role_id') != ROLE_ID_GUEST){ ?>
        <li><?= $this->Html->link(__('登録'), ['action' => 'add', $device->center->id]) ?> </li>
        <li><?= $this->Html->link(__('編集'), ['action' => 'edit', $device->id]) ?> </li><!--
        <li><?= $this->Form->postLink(__('削除'), ['action' => 'delete', $device->id], ['confirm' => __(DELETE_CONFIRM.' # {0}?', $device->id)]) ?> </li>-->
        <?php } ?>
    </ul>
    <?php echo $this->element('navi_master'); ?>
</nav>
<div class="devices view large-9 medium-8 columns content">
    <h4 style="float: left"><?= h($device->name) ?></h3>
    <div style="float: right">
        <?php if($this->request->session()->read('Auth.User.m_role_id') != ROLE_ID_GUEST){ ?>
        <?= $this->Form->button('編集', ['type' => 'button', 'class' => 'download_button', 'onclick' => "window.location.href = '/center_info/devices/edit/$device->id'"]) ?>
        <?php } ?>
        <?= $this->Form->button('一覧に戻る', ['type' => 'button', 'class' => 'download_button', 'onclick' => "window.location.href = '/center_info/devices'"]) ?>
    </div>
    <div style="clear: both;"></div>
    <table class="">
        <tr>
            <th scope="row"><?= __('拠点') ?></th>
            <td colspan="5"><?= $device->has('center') ? $this->Html->link($device->center->name, ['controller' => 'Centers', 'action' => 'view', $device->center->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('受入No') ?></th>
            <td><?= h($device->accepted_no) ?></td>
            <th scope="row"><?= __('端末種別') ?></th>
            <td style="background-color: <?= $device->has('m_device_type') ? $device->m_device_type->background_color : '' ?>;"><?= $device->has('m_device_type') ? $device->m_device_type->name : '' ?></td>
            <td colspan="2"></td>
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
                echo $this->Form->button('COPY', ['type' => 'button', 'class' => 'copy_button', 'onclick' => 'clipboardCopy(\''.$device->ip_higher.'\');']);
            } ?></td>
            <th scope="row"><?= __('下位IP') ?></th>
            <td><?= h($device->ip_lower) ?><?php if(!empty($device->ip_lower)){
                echo '&nbsp;';
                echo $this->Form->button('COPY', ['type' => 'button', 'class' => 'copy_button', 'onclick' => 'clipboardCopy(\''.$device->ip_lower.'\');']);
            } ?></td>
            <th scope="row"><?= __('AdminPass') ?></th>
            <td><?= h($device->admin_pass) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('設置日') ?></th>
            <td><?= h($device->setup_date) ?></td>
            <th scope="row"><?= __('保守終了日') ?></th>
            <td colspan="3"><?= h($device->support_end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('予備') ?></th>
            <td><?= $device->reserve_flag ? __(LIST_CHECK_MARK) : __('') ?></td>
        <!--
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($device->id) ?></td>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($device->created) ?></td>
        -->
            <th scope="row"><?= __('稼働中') ?></th>
            <td><?= $device->running_flag ? __(LIST_CHECK_MARK) : __('') ?></td>
            <th scope="row"><?= __('セキュリティソフト') ?></th>
            <td><?= $sec_flag[$device->security_flag] ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('OS種別') ?></th>
            <td style="background-color: <?= $device->has('m_operation_system') ? $device->m_operation_system->background_color : '' ?>;"><?= $device->has('m_operation_system') ? $device->m_operation_system->name : '' ?></td>
            <th scope="row"><?= __('SQLServer種別') ?></th>
            <td style="background-color: <?= $device->has('m_sqlserver') ? $device->m_sqlserver->background_color : '' ?>;"><?= $device->has('m_sqlserver') ? $device->m_sqlserver->name : '' ?></td>
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
    <?php if($this->request->session()->read('Auth.User.m_role_id') != ROLE_ID_GUEST){ ?>
    <div style="text-align: right">
    <?= $this->Form->button('リプレイス登録［一部引継ぎ］', ['type' => 'button', 'class' => 'copy_button', 'onclick' => "window.location.href = ('".$this->Url->build('/devices/add/'.$device->center->id.'/'.$device->id). "')"]) ?><br/>
    <?= $this->Form->button('拠点移設登録［全情報引継ぎ］', ['type' => 'button', 'class' => 'copy_button', 'onclick' => "window.location.href = ('".$this->Url->build('/devices/add/'.$device->center->id.'/'.$device->id.'/move'). "')"]) ?>
    </div>
    <?php } ?>
    <div class="row">
        <h4><?= __('写真') ?></h4>
        <?= $this->Form->button('写真保存', ['type' => 'button', 'id' => 'openModal', 'class' => 'copy_button', 'onclick' => "openModal('Photo')"]) ?>
        <?php if (!empty($device->photos)): ?>
        <div class="photos">
        <?php foreach ($device->photos as $pho): ?>
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
        <?= $this->Form->button('ファイル保存', ['type' => 'button', 'class' => 'copy_button', 'onclick' => "openModal('File')"]) ?>
        <?php if (!empty($device->documents)): ?>
        <table class="">
            <tr>
                <th scope="col"><?= __('ファイル') ?></th>
                <th scope="col" class="th_short"><?= __('') ?></th>
            </tr>
        <?php foreach ($device->documents as $doc): ?>
            <tr>
                <td><?= $this->Form->postLink(__($doc->file_name), ['cntroller' => 'Devices', 'action' => 'download', $doc->id]) ?></td>
                <td><?= '&nbsp;'.$this->Form->button('削除', ['type' => 'button', 'class' => 'copy_button', 'onclick' => "delFile('".$doc->file_name."', '".$doc->id."')"]) ?></td>
            </tr>
        <?php endforeach; ?>            
        </table>
        <?php endif; ?>
    </div>
    <div class="row">
        <h4><?= __('改造内容') ?></h4>
        <?= $this->Text->autoParagraph(h($device->custom)); ?>
    </div>
    <div class="row">
        <h4><?= __('備考') ?></h4>
        <?= $this->Text->autoParagraph(h($device->remarks)); ?>
    </div>
    <!--
    <div class="related">
        <h4><?= __('改造履歴') ?></h4>
        <?= $this->Form->button('改造履歴登録', ['type' => 'button', 'class' => 'copy_button', 'onclick' => "openModal('Custom')"]) ?>
        <?php if (!empty($device->customs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col" class="th_short"><?= __('受入No') ?></th>
                <th scope="col"><?= __('内容') ?></th>
                <th scope="col" class="th_short"><?= __('ユーザー') ?></th>
                <th scope="col" class="th_ymd"><?= __('登録日時') ?></th>
                <th scope="col" class="th_short"><?= __('') ?></th>
            </tr>
            <?php foreach ($device->customs as $customs): ?>
            <tr>
                <td><?= h($customs->accepted_no) ?></td>
                <td><?= $this->Text->autoParagraph(h($customs->content)) ?></td>
                <td><?= array_key_exists($customs->m_user_id, $mUsers) ? $mUsers[$customs->m_user_id] : $customs->m_user_id; ?></td>
                <td><?= h($customs->created) ?></td>
                <td class="actions"><?= '&nbsp;'.$this->Form->button('削除', ['type' => 'button', 'class' => 'copy_button', 'onclick' => "delCustom('".$customs->id."')"]) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('コメント') ?></h4>
        <?= $this->Form->button('コメント登録', ['type' => 'button', 'class' => 'copy_button', 'onclick' => "openModal('Comment')"]) ?>
        <?php if (!empty($device->comments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('コメント') ?></th>
                <th scope="col" class="th_short"><?= __('ユーザー') ?></th>
                <th scope="col" class="th_ymd"><?= __('登録日時') ?></th>
                <th scope="col" class="th_short"><?= __('') ?></th>
            </tr>
            <?php foreach ($device->comments as $comments): ?>
            <tr>
                <td><?= h($comments->content) ?></td>
                <td><?= array_key_exists($comments->m_user_id, $mUsers) ? $mUsers[$comments->m_user_id] : $comments->m_user_id; ?></td>
                <td><?= h($comments->created) ?></td>
                <td class="actions"><?= '&nbsp;'.$this->Form->button('削除', ['type' => 'button', 'class' => 'copy_button', 'onclick' => "delComment('".$comments->id."')"]) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    -->
</div>
<!-- モーダルエリアここから -->
<section id="modalAreaPhoto" class="modal_area">
    <div class="modal_bg" onclick="closeModal('Photo')"></div>
    <div class="modal_wrapper">
        <div class="modal_contents">
            <?= $this->Form->create($device, ['action' => 'addPhoto/'.$device->id, 'enctype' => 'multipart/form-data', 'id' => 'addPhotoForm']) ?>
            <div id="drop-zone-photo" class="drop-zone">
                <p>ファイルを「ドラッグ＆ドロップ」もしくは「参照指定」</p>
            <?php 
                echo $this->Form->hidden('center_id', ['value' => $device->center->id]);
                echo $this->Form->hidden('device_id', ['value' => $device->id]);
                echo $this->Form->file('import_file');
                echo $this->Form->hidden('file_name', ['value' => '']);
                echo $this->Form->hidden('file_path', ['value' => '']);
                echo $this->Form->hidden('file_path_thmb', ['value' => '']);
                echo $this->Form->hidden('remarks', ['value' => '']);
                echo $this->Form->hidden('delete_flag', ['value' => 0]);
                echo $this->Form->hidden('m_user_id', ['value' => $this->request->session()->read('Auth.User.id')]);
            ?>
            </div>
            <?= $this->Form->button(__('登録')) ?>
            <?= $this->Form->end() ?>
            <div class="loading hide"></div>
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
            <?= $this->Form->create($device, ['action' => 'addFile/'.$device->id, 'enctype' => 'multipart/form-data', 'id' => 'addFileForm']) ?>
            <div id="drop-zone-file" class="drop-zone">
                <p>ファイルを「ドラッグ＆ドロップ」もしくは「参照指定」</p>
            <?php 
                echo $this->Form->hidden('center_id', ['value' => $device->center->id]);
                echo $this->Form->hidden('device_id', ['value' => $device->id]);
                echo $this->Form->file('import_file');
                echo $this->Form->hidden('file_name', ['value' => '']);
                echo $this->Form->hidden('file_path', ['value' => '']);
                echo $this->Form->hidden('file_path_thmb', ['value' => '']);
                echo $this->Form->hidden('remarks', ['value' => '']);
                echo $this->Form->hidden('delete_flag', ['value' => 0]);
                echo $this->Form->hidden('m_user_id', ['value' => $this->request->session()->read('Auth.User.id')]);
            ?>
            </div>
            <?= $this->Form->button(__('登録')) ?>
            <?= $this->Form->end() ?>
            <div class="loading hide"></div>
            ※ファイルサイズは10MB未満としてください
        </div>
        <div class="close_modal" onclick="closeModal('File')">
        ×
        </div>
    </div>
</section>
<section id="modalAreaCustom" class="modal_area">
    <div class="modal_bg" onclick="closeModal('Custom')"></div>
    <div class="modal_wrapper">
        <div class="modal_contents">
            <?= $this->Form->create($device, ['type' => 'post', 'url' => '/customs/add/']) ?>
            <fieldset>
            <?php 
                echo $this->Form->hidden('device_id', ['value' => $device->id]);
                echo $this->Form->control('accepted_no', ['label' => '受入No', 'style' => 'width: 100px;']);
                echo $this->Form->control('content', ['label' => '改造内容', 'type' => 'textarea', 'style' => 'width: 500px;']);
                echo $this->Form->hidden('exe_file', ['label' => '実行ファイル', 'value' => '']);
                echo $this->Form->hidden('config_file', ['label' => '設定ファイル', 'value' => '']);
                echo $this->Form->hidden('hht_file', ['label' => 'HHTファイル', 'value' => '']);
                echo $this->Form->hidden('db_custom', ['label' => 'DB変更', 'value' => '']);
                echo $this->Form->hidden('delete_flag', ['value' => 0]);
                echo $this->Form->hidden('m_user_id', ['value' => $this->request->session()->read('Auth.User.id')]);
            ?>
            <?= $this->Form->button(__('登録')) ?>
            </fieldset>
            <?= $this->Form->end() ?>
        </div>
        <div class="close_modal" onclick="closeModal('Custom')">
        ×
        </div>
    </div>
</section>
<section id="modalAreaComment" class="modal_area">
    <div class="modal_bg" onclick="closeModal('Comment')"></div>
    <div class="modal_wrapper">
        <div class="modal_contents">
            <?= $this->Form->create($device, ['type' => 'post', 'url' => '/comments/add/']) ?>
            <fieldset>
            <?php
                echo $this->Form->hidden('device_id', ['value' => $device->id]);
                echo $this->Form->control('content', ['label' => 'コメント', 'type' => 'textarea', 'style' => 'width: 500px;']);
                echo $this->Form->hidden('delete_flag', ['value' => 0]);
                echo $this->Form->hidden('m_user_id', ['value' => $this->request->session()->read('Auth.User.id')]);
            ?>
            <?= $this->Form->button(__('登録')) ?>
            </fieldset>
            <?= $this->Form->end() ?>
        </div>
        <div class="close_modal" onclick="closeModal('Comment')">
        ×
        </div>
    </div>
</section>
<!-- モーダルエリアここまで -->