<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Center $center
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= TITLE_CENTER ?></li>
        <li><?= $this->Html->link(__('一覧'), ['action' => 'index']) ?> </li>
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= TITLE_DEVICE ?></li>
        <li><?= $this->Html->link(__('一覧'), ['controller' => 'Devices', 'action' => 'index']) ?></li>
    </ul>
    <?php echo $this->element('navi_master'); ?>
</nav>
<div class="centers form large-9 medium-8 columns content">
    <?= $this->Form->create($center) ?>
    <fieldset>
        <legend><?= __('拠点登録') ?></legend>
        <?php
            echo "<div class='float_10'>";
            echo $this->Form->control('m_customer_id', ['options' => $mCustomers, 'label' => '顧客', 'style' => 'width: 200px;']);
            echo "</div>";
            echo $this->Form->control('name', ['label' => '拠点名', 'style' => 'width: 400px;']);
            
            echo "<div class='float_05'>";
            echo $this->Form->control('postcode', ['label' => '郵便番号', 'style' => 'width: 100px;']);
            echo "</div>";
            echo "<div class='float_05'>";
            echo $this->Form->control('m_prefecture_id', ['options' => $mPrefectures, 'empty' => true, 'label' => '都道府県', 'style' => 'width: 100px;']);
            echo "</div>";
            echo $this->Form->control('address', ['label' => '住所', 'style' => 'width: 400px;']);
            
            echo $this->Form->control('tel', ['label' => '電話番号', 'style' => 'width: 250px;']);
            
            echo "<div class='float_15'>";
            echo $this->Form->control('thermo_dry_flag', ['label' => '【温度帯】ドライ']);
            echo "</div>";
            echo "<div class='float_15'>";
            echo $this->Form->control('thermo_chilled_flag', ['label' => '【温度帯】チルド']);
            echo "</div>";
            echo "<div class='float_30'>";
            echo $this->Form->control('thermo_frozen_flag', ['label' => '【温度帯】フローズン']);
            echo "</div>";
            echo $this->Form->control('shoes_flag', ['label' => '要上履き']);
            
            echo "<div class='float_10'>";
            echo $this->Form->control('officer', ['label' => '責任者', 'style' => 'width: 250px;']);
            echo "</div>";
            echo $this->Form->control('staff', ['label' => '担当者', 'style' => 'width: 250px;']);
            
            echo $this->Form->control('access', ['label' => 'アクセス', 'style' => 'width: 700px;']);
            echo $this->Form->control('job', ['label' => '業務内容', 'style' => 'width: 700px;']);
            echo $this->Form->control('remarks', ['label' => '備考', 'style' => 'width: 700px;']);
            
            echo $this->Form->hidden('delete_flag', ['value' => 0]);
            echo $this->Form->hidden('m_user_id', ['value' => $this->request->session()->read('Auth.User.id')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('登録')) ?>
    <?= $this->Form->end() ?>
</div>
