<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device $device
 */
?>
<script type="text/javascript">
$(document).ready(function()
{
    // 顧客・拠点リスト連動
    $('#search-m-customer-id').change(function()
    {
        $('#center_list').load('/center_info/devices/addCenterList/' + $(this).val());
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
        <li><?= $this->Html->link(__('一覧'), ['action' => 'index']) ?></li>
    </ul>
    <?php echo $this->element('navi_master'); ?>
</nav>
<div class="devices form large-9 medium-8 columns content">
    <?= $this->Form->create($device) ?>
    <h4 style="float: left">端末登録</h4>
    <div style="float: right">
        <?= $this->Form->button('一覧に戻る', ['type' => 'button', 'class' => 'download_button', 'onclick' => "window.location.href = '/center_info/devices'"]) ?>
    </div>
    <div style="clear: both;"></div>
    <fieldset>
        <?php
            echo "<div class='float_10'>";
            echo $this->Form->control('search_m_customer_id', ['options' => $mCustomers, 'value' => $m_customer_id, 'label' => '顧客', 'style' => 'width: 300px;']);
            echo "</div>";
            echo '<span id="center_list">';
            echo $this->Form->control('center_id', ['options' => $centers, 'value' => $center_id, 'label' => '拠点', 'style' => 'width: 300px;']);
            echo '</span>';

            echo "<div class='float_10'>";
            echo $this->Form->control('accepted_no', ['label' => '受入No', 'style' => 'width: 300px;']);
            echo "</div>";
            echo $this->Form->control('m_device_type_id', ['options' => $mDeviceTypes, 'label' => '端末種別', 'style' => 'width: 200px;']);

            echo "<div class='float_05'>";
            echo $this->Form->control('name', ['label' => '端末名', 'style' => 'width: 200px;']);
            echo "</div>";
            echo "<div class='float_05'>";
            echo $this->Form->control('model', ['label' => '型式', 'style' => 'width: 250px;']);
            echo "</div>";
            echo $this->Form->control('serial_no', ['label' => '製造番号', 'style' => 'width: 200px;']);

            echo "<div class='float_05'>";
            echo $this->Form->control('ip_higher', ['label' => '上位IP', 'style' => 'width: 200px;']);
            echo "</div>";
            echo "<div class='float_05'>";
            echo $this->Form->control('ip_lower', ['label' => '下位IP', 'style' => 'width: 200px;']);
            echo "</div>";
            echo $this->Form->control('admin_pass', ['label' => 'AdminPass', 'style' => 'width: 250px;']);

            echo "<div class='float_05'>";
            echo $this->Form->control('ip_higher_ex', ['label' => '追加上位IP', 'style' => 'width: 200px;']);
            echo "</div>";
            echo "<div class='float_05'>";
            echo $this->Form->control('ip_lower_ex', ['label' => '追加下位IP', 'style' => 'width: 200px;']);
            echo "</div>";
            echo $this->Form->control('setup_place', ['label' => '設置場所', 'style' => 'width: 250px;']);

            echo "<div class='float_30'>";
            echo $this->Form->control('setup_date', ['dateFormat' => 'YMD', 'monthNames' => false, 'maxYear' => date('Y') + 10, 'minYear' => date('Y') - 5, 'empty' => true, 'label' => '設置日']);
            echo "</div>";
            echo "<div class='float_30'>";
            echo $this->Form->control('support_end_date', ['dateFormat' => 'YMD', 'monthNames' => false, 'maxYear' => date('Y') + 10, 'minYear' => date('Y') - 5, 'empty' => true, 'label' => '保守終了日']);
            echo "</div>";
            echo $this->Form->control('security_flag', ['options' => [0 => '未', 1 => '済', 2 => '予'], 'label' => 'セキュリティソフト', 'style' => 'width: 100px;']);
            
            echo "<div class='float_05'>";
            echo $this->Form->control('m_operation_system_id', ['options' => $mOperationSystems, 'empty' => true, 'label' => 'OS種別', 'style' => 'width: 250px;']);
            echo "</div>";
            echo "<div class='float_05'>";
            echo $this->Form->control('m_sqlserver_id', ['options' => $mSqlservers, 'empty' => true, 'label' => 'SQLServer種別', 'style' => 'width: 200px;']);
            echo "</div>";
            echo $this->Form->control('connect', ['label' => '接続先', 'style' => 'width: 200px;']);
            
            echo "<div class='float_05'>";
            echo $this->Form->control('m_product_id', ['options' => $mProducts, 'empty' => true, 'label' => '製造', 'style' => 'width: 200px;']);
            echo "</div>";
            echo "<div class='float_05'>";
            echo $this->Form->control('m_version_id', ['options' => $mVersions, 'empty' => true, 'label' => 'Appバージョン', 'style' => 'width: 200px;']);
            echo "</div>";
            echo "<div class='float_05'>";
            echo $this->Form->control('remote', ['label' => 'リモート', 'style' => 'width: 200px;']);
            echo "</div>";
            echo $this->Form->control('raid', ['label' => 'RAIDレベル', 'style' => 'width: 50px;']);
            
            //echo "<div class='float_30'>";
            echo $this->Form->control('reserve_flag', ['label' => '予備']);
            //echo "</div>";
            //echo $this->Form->control('running_flag', ['label' => '稼働中']);
            
            echo $this->Form->control('custom', ['label' => '改造内容', 'style' => 'width: 700px;']);
            echo $this->Form->control('remarks', ['label' => '備考', 'style' => 'width: 700px;']);
            echo $this->Form->hidden('delete_flag', ['value' => 0]);
            echo $this->Form->hidden('m_user_id', ['value' => $this->request->session()->read('Auth.User.id')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('登録')) ?>
    <?= $this->Form->end() ?>
</div>
