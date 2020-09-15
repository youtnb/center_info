<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Center $center
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
            url: '/center_info/centers/addPhotoAjax/<?= $center->id; ?>',
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
                    window.location.href = './<?= $center->id; ?>';
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
            url: '/center_info/centers/addFileAjax/<?= $center->id; ?>',
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
                    window.location.href = './<?= $center->id; ?>';
                },
            error : function(){
                    alert("登録エラーになりました。管理者にご確認ください。");
                }
        });
    }, false);
    
    $('#display_delete').click(function() {
        $(".delrow").toggle(200);
        if($('#display_delete').text() == '▼削除表示')
        {
            $('#display_delete').text('▲削除済非表示')
        }
        else
        {
            $('#display_delete').text('▼削除表示')
        }

    });
});

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
        <?php if($this->request->session()->read('Auth.User.m_role_id') != ROLE_ID_GUEST){ ?>
        <li><?= $this->Html->link(__('登録'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('編集'), ['action' => 'edit', $center->id]) ?> </li><!--
        <li><?= $this->Form->postLink(__('削除'), ['action' => 'delete', $center->id], ['confirm' => __(DELETE_CONFIRM.' # {0}?', $center->id)]) ?> </li>-->
        <?php } ?>
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= TITLE_DEVICE ?></li>
        <li><?= $this->Html->link(__('一覧'), ['controller' => 'Devices', 'action' => 'index']) ?> </li>
        <?php if($this->request->session()->read('Auth.User.m_role_id') != ROLE_ID_GUEST){ ?>
        <li><?= $this->Html->link(__('登録'), ['controller' => 'Devices', 'action' => 'add', $center->id]) ?></li>
        <?php } ?>
    </ul>
    <?php echo $this->element('navi_master'); ?>
</nav>
<div class="centers view large-9 medium-8 columns content">
    <h4 style="float: left"><?= h($center->name) ?></h3>
    <div style="float: right">
        <?php if($this->request->session()->read('Auth.User.m_role_id') != ROLE_ID_GUEST){ ?>
        <?= $this->Form->button('端末登録', ['type' => 'button', 'class' => 'download_button', 'onclick' => "window.location.href = '/center_info/devices/add/$center->id'"]) ?>
        <?= $this->Form->button('編集', ['type' => 'button', 'class' => 'download_button', 'onclick' => "window.location.href = '/center_info/centers/edit/$center->id'"]) ?>
        <?php } ?>
        <?= $this->Form->button('一覧に戻る', ['type' => 'button', 'class' => 'download_button', 'onclick' => "window.location.href = '/center_info/centers'"]) ?>
    </div>
    <div style="clear: both;"></div>
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
                if (!empty($center->map))
                {
                    echo '&nbsp;';
                    echo $this->Form->button('GoogleMap', ['type' => 'button', 'class' => 'copy_button', 'onclick' => "window.open('$center->map','_blank','')"]);
                }
            ?>
            </td>
        </tr>
        <?php if ($same_list): ?>
        <tr>
            <th scope="row"><?= __('同一建屋') ?></th>
            <td colspan="3">
            <?php foreach ($same_list as $id => $name): ?>
                <?= $this->Html->link($name, ['controller' => 'Centers', 'action' => 'view', $id], ['target' => '_blank']); ?><br />
            <?php endforeach; ?>
            </td>
        </tr>
        <?php endif; ?>
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
        <?php if (!empty($center->devices) || !empty($delDevices)): ?>
        <!--
        <?= $this->Form->button('CSVダウンロード', ['type' => 'button', 'class' => 'download_button', 'onclick' => "window.location.href = '/center_info/centers/getDevices/$center->id'"]) ?>
        <div style="float: right;">
            <?= $this->Form->button('CSV一括更新', ['type' => 'button', 'class' => 'download_button', 'onclick' => "openModal('Devices')"]) ?>
        </div>
        -->
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col" class="th_short_20"><?= __('端末名') ?></th>
                <th scope="col" class="th_min"><?= __('端末種別') ?></th><!--
                <th scope="col" class="th_short"><?= __('受入No') ?></th>-->
                <th scope="col" class="th_ip"><?= __('上位IP') ?></th>
                <th scope="col" class="th_ip"><?= __('下位IP') ?></th>
                <th scope="col" class="th_flag"><?= __('予備') ?></th>
                <th scope="col" class="th_ymd"><?= __('設置日') ?></th>
                <th scope="col" class="th_ymd"><?= __('サポート終了') ?></th><!--
                <th scope="col"><?= __('接続先') ?></th>
                <th scope="col"><?= __('リモート') ?></th>-->
                <?php if($this->request->session()->read('Auth.User.m_role_id') != ROLE_ID_GUEST){ ?>
                <th scope="col" class="actions th_min"></th>
                <?php } ?>
            </tr>
            <?php foreach ($center->devices as $devices): ?>
            <tr class="clickable <?= $devices->delete_flag?'delete_content':'' ?>" data-href="<?= $this->Url->build(['controller' => 'Devices', 'action' => 'view', $devices->id]) ?>">
                <td><?= h($devices->name) ?></td>
                <td style="background-color: <?= h($device_color_list[$devices->m_device_type_id]) ?>;"><?= h($mDeviceTypes[$devices->m_device_type_id]) ?></td><!--
                <td><?= h($devices->accepted_no) ?></td>-->
                <td><?= h($devices->ip_higher) ?><?php if(!empty($devices->ip_higher_ex)){
                    echo '<br />';
                    echo $devices->ip_higher_ex;
                } ?></td>
                <td><?= h($devices->ip_lower) ?><?php if(!empty($devices->ip_lower_ex)){
                    echo '<br />';
                    echo $devices->ip_lower_ex;
                } ?></td>
                <td><?php if($devices->reserve_flag){ echo LIST_CHECK_MARK; } ?></td>
                <td><?= h($devices->setup_date) ?></td>
                <td><?= h($devices->support_end_date) ?></td><!--
                <td><?= h($devices->connect) ?></td>
                <td><?= h($devices->remote) ?></td>-->
                <?php if($this->request->session()->read('Auth.User.m_role_id') != ROLE_ID_GUEST){ ?>
                <td class="actions">
                    <!-- <?= $this->Html->link(__('閲覧'), ['controller' => 'Devices', 'action' => 'view', $devices->id]) ?>
                    /
                    --><?= $this->Html->link(__('編集'), ['controller' => 'Devices', 'action' => 'edit', $devices->id]) ?>
                </td>
                <?php } ?>
            </tr>
            <?php endforeach; ?>
            <?php foreach ($delDevices as $devices): ?>
            <tr class="delrow clickable <?= $devices->delete_flag?'delete_content':'' ?>" data-href="<?= $this->Url->build(['controller' => 'Devices', 'action' => 'view', $devices->id]) ?>" style="display: none;">
                <td><?= h($devices->name) ?></td>
                <td style="background-color: <?= h($device_color_list[$devices->m_device_type_id]) ?>;"><?= h($mDeviceTypes[$devices->m_device_type_id]) ?></td>
                <td><?= h($devices->ip_higher) ?><?php if(!empty($devices->ip_higher_ex)){
                    echo '&nbsp;';
                    echo $devices->ip_higher_ex;
                } ?></td>
                <td><?= h($devices->ip_lower) ?><?php if(!empty($devices->ip_lower_ex)){
                    echo '&nbsp;';
                    echo $devices->ip_lower_ex;
                } ?></td>
                <td><?php if($devices->reserve_flag){ echo LIST_CHECK_MARK; } ?></td>
                <td><?= h($devices->setup_date) ?></td>
                <td><?= h($devices->support_end_date) ?></td><!--
                <td><?= h($devices->connect) ?></td>
                <td><?= h($devices->remote) ?></td>-->
                <?php if($this->request->session()->read('Auth.User.m_role_id') != ROLE_ID_GUEST){ ?>
                <td class="actions">
                    <!-- <?= $this->Html->link(__('閲覧'), ['controller' => 'Devices', 'action' => 'view', $devices->id]) ?>
                    /
                    --><?= $this->Html->link(__('編集'), ['controller' => 'Devices', 'action' => 'edit', $devices->id]) ?>
                </td>
                <?php } ?>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php if (!empty($delDevices->toArray())): ?>
        <div style="float: right">
            <?= $this->Form->button('▼削除表示', ['type' => 'button', 'id' => 'display_delete', 'class' => 'copy_button', 'onclick' => 'return false']) ?>
        </div>
        <?php endif; ?>
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
            <?= $this->Form->create($center, ['action' => 'addPhoto/'.$center->id, 'enctype' => 'multipart/form-data', 'id' => 'addPhotoForm']) ?>
            <div id="drop-zone-photo" class="drop-zone">
                <p>ファイルを「ドラッグ＆ドロップ」もしくは「参照指定」</p>
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
            <?= $this->Form->create($center, ['action' => 'addFile/'.$center->id, 'enctype' => 'multipart/form-data', 'id' => 'addFileForm']) ?>
            <div id="drop-zone-file" class="drop-zone">
                <p>ファイルを「ドラッグ＆ドロップ」もしくは「参照指定」</p>
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