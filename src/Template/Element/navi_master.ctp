    <ul class="side-nav">
        <li class="heading"><?= __('マスタ管理') ?></li>
        <?php if(!isset($own)){$own='';} ?>
        <li><?php if($own != 'MCustomers'){?><?= $this->Html->link(__('顧客マスタ'), ['controller' => 'MCustomers', 'action' => 'index']) ?><?php }else{ ?><span class="no-anc">顧客マスタ</span><?php } ?></li>
        <li><?php if($own != 'MDeviceTypes'){?><?= $this->Html->link(__('端末種別マスタ'), ['controller' => 'MDeviceTypes', 'action' => 'index']) ?><?php }else{ ?><span class="no-anc">端末種別マスタ</span><?php } ?></li>
        <li><?php if($own != 'MOperationSystems'){?><?= $this->Html->link(__('OS種別マスタ'), ['controller' => 'MOperationSystems', 'action' => 'index']) ?><?php }else{ ?><span class="no-anc">OS種別マスタ</span><?php } ?></li>
        <li><?php if($own != 'MSqlservers'){?><?= $this->Html->link(__('SQLServer種別マスタ'), ['controller' => 'MSqlservers', 'action' => 'index']) ?><?php }else{ ?><span class="no-anc">SQLServer種別マスタ</span><?php } ?></li>
        <li><?php if($own != 'MProducts'){?><?= $this->Html->link(__('製造種別マスタ'), ['controller' => 'MProducts', 'action' => 'index']) ?><?php }else{ ?><span class="no-anc">製造種別マスタ</span><?php } ?></li>
        <li><?php if($own != 'MVersions'){?><?= $this->Html->link(__('バージョンマスタ'), ['controller' => 'MVersions', 'action' => 'index']) ?><?php }else{ ?><span class="no-anc">バージョンマスタ</span><?php } ?></li>
        <?php if($this->request->session()->read('Auth.User.m_role_id') == ROLE_ID_ADMIN){ ?>
        <li><?php if($own != 'MUsers'){?><?= $this->Html->link(__('ユーザーマスタ'), ['controller' => 'MUsers', 'action' => 'index']) ?><?php }else{ ?><span class="no-anc">ユーザーマスタ</span><?php } ?></li>
        <li><?php if($own != 'MDepartments'){?><?= $this->Html->link(__('部署マスタ'), ['controller' => 'MDepartments', 'action' => 'index']) ?><?php }else{ ?><span class="no-anc">部署マスタ</span><?php } ?></li>
        <li><?php if($own != 'MRoles'){?><?= $this->Html->link(__('ロールマスタ'), ['controller' => 'MRoles', 'action' => 'index']) ?><?php }else{ ?><span class="no-anc">ロールマスタ</span><?php } ?></li>
        <?php } ?>
    </ul>
    <ul class="side-nav">
        <li><span class="no-anc">ログイン：<?= $this->request->session()->read('Auth.User.name') ?></span></li>
    </ul>