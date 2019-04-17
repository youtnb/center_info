    <ul class="side-nav">
        <li class="heading"><?= __('マスタ管理') ?></li>
        <?php if(!isset($own)){$own='';} ?>
        <?php if($own != '顧客マスタ'){?>
        <li><?= $this->Html->link(__('顧客マスタ'), ['controller' => 'MCustomers', 'action' => 'index']) ?></li>
        <?php }?>
        <?php if($own != '端末種別マスタ'){?>
        <li><?= $this->Html->link(__('端末種別マスタ'), ['controller' => 'MDeviceTypes', 'action' => 'index']) ?></li>
        <?php }?>
        <?php if($own != 'OS種別マスタ'){?>
        <li><?= $this->Html->link(__('OS種別マスタ'), ['controller' => 'MOperationSystems', 'action' => 'index']) ?></li>
        <?php }?>
        <?php if($own != 'SQLServer種別マスタ'){?>
        <li><?= $this->Html->link(__('SQLServer種別マスタ'), ['controller' => 'MSqlservers', 'action' => 'index']) ?></li>
        <?php }?>
        <?php if($own != '製造種別マスタ'){?>
        <li><?= $this->Html->link(__('製造種別マスタ'), ['controller' => 'MProducts', 'action' => 'index']) ?></li>
        <?php }?>
        <?php if($own != 'バージョンマスタ'){?>
        <li><?= $this->Html->link(__('バージョンマスタ'), ['controller' => 'MVersions', 'action' => 'index']) ?></li>
        <?php }?>
        <?php if($own != 'ユーザーマスタ'){?>
        <li><?= $this->Html->link(__('ユーザーマスタ'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <?php }?>
        <?php if($own != '部署マスタ'){?>
        <li><?= $this->Html->link(__('部署マスタ'), ['controller' => 'MDepartments', 'action' => 'index']) ?></li>
        <?php }?>
        <?php if($own != 'ロールマスタ'){?>
        <li><?= $this->Html->link(__('ロールマスタ'), ['controller' => 'MRoles', 'action' => 'index']) ?></li>
        <?php }?>
    </ul>
