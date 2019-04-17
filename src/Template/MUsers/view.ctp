<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MUser $mUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit M User'), ['action' => 'edit', $mUser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete M User'), ['action' => 'delete', $mUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mUser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List M Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List M Departments'), ['controller' => 'MDepartments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Department'), ['controller' => 'MDepartments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List M Roles'), ['controller' => 'MRoles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Role'), ['controller' => 'MRoles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Centers'), ['controller' => 'Centers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Center'), ['controller' => 'Centers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Devices'), ['controller' => 'Devices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Device'), ['controller' => 'Devices', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List M Customers'), ['controller' => 'MCustomers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Customer'), ['controller' => 'MCustomers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List M Device Types'), ['controller' => 'MDeviceTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Device Type'), ['controller' => 'MDeviceTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List M Operation Systems'), ['controller' => 'MOperationSystems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Operation System'), ['controller' => 'MOperationSystems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List M Products'), ['controller' => 'MProducts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Product'), ['controller' => 'MProducts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List M Sqlservers'), ['controller' => 'MSqlservers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Sqlserver'), ['controller' => 'MSqlservers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List M Versions'), ['controller' => 'MVersions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Version'), ['controller' => 'MVersions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mUsers view large-9 medium-8 columns content">
    <h3><?= h($mUser->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($mUser->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($mUser->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($mUser->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M Department') ?></th>
            <td><?= $mUser->has('m_department') ? $this->Html->link($mUser->m_department->name, ['controller' => 'MDepartments', 'action' => 'view', $mUser->m_department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M Role') ?></th>
            <td><?= $mUser->has('m_role') ? $this->Html->link($mUser->m_role->name, ['controller' => 'MRoles', 'action' => 'view', $mUser->m_role->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mUser->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mUser->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mUser->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete Flag') ?></th>
            <td><?= $mUser->delete_flag ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Centers') ?></h4>
        <?php if (!empty($mUser->centers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('M Customer Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Postcode') ?></th>
                <th scope="col"><?= __('M Prefecture Id') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Tel') ?></th>
                <th scope="col"><?= __('Officer') ?></th>
                <th scope="col"><?= __('Staff') ?></th>
                <th scope="col"><?= __('Access') ?></th>
                <th scope="col"><?= __('Job') ?></th>
                <th scope="col"><?= __('Remarks') ?></th>
                <th scope="col"><?= __('Shoes Flag') ?></th>
                <th scope="col"><?= __('Delete Flag') ?></th>
                <th scope="col"><?= __('M User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mUser->centers as $centers): ?>
            <tr>
                <td><?= h($centers->id) ?></td>
                <td><?= h($centers->m_customer_id) ?></td>
                <td><?= h($centers->name) ?></td>
                <td><?= h($centers->postcode) ?></td>
                <td><?= h($centers->m_prefecture_id) ?></td>
                <td><?= h($centers->address) ?></td>
                <td><?= h($centers->tel) ?></td>
                <td><?= h($centers->officer) ?></td>
                <td><?= h($centers->staff) ?></td>
                <td><?= h($centers->access) ?></td>
                <td><?= h($centers->job) ?></td>
                <td><?= h($centers->remarks) ?></td>
                <td><?= h($centers->shoes_flag) ?></td>
                <td><?= h($centers->delete_flag) ?></td>
                <td><?= h($centers->m_user_id) ?></td>
                <td><?= h($centers->created) ?></td>
                <td><?= h($centers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Centers', 'action' => 'view', $centers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Centers', 'action' => 'edit', $centers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Centers', 'action' => 'delete', $centers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $centers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Comments') ?></h4>
        <?php if (!empty($mUser->comments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Device Id') ?></th>
                <th scope="col"><?= __('Content') ?></th>
                <th scope="col"><?= __('Delete Flag') ?></th>
                <th scope="col"><?= __('M User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mUser->comments as $comments): ?>
            <tr>
                <td><?= h($comments->id) ?></td>
                <td><?= h($comments->device_id) ?></td>
                <td><?= h($comments->content) ?></td>
                <td><?= h($comments->delete_flag) ?></td>
                <td><?= h($comments->m_user_id) ?></td>
                <td><?= h($comments->created) ?></td>
                <td><?= h($comments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Comments', 'action' => 'view', $comments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Comments', 'action' => 'delete', $comments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Devices') ?></h4>
        <?php if (!empty($mUser->devices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Center Id') ?></th>
                <th scope="col"><?= __('M Device Type Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Ip Higher') ?></th>
                <th scope="col"><?= __('Ip Lower') ?></th>
                <th scope="col"><?= __('Reserve Flag') ?></th>
                <th scope="col"><?= __('Security Flag') ?></th>
                <th scope="col"><?= __('Model') ?></th>
                <th scope="col"><?= __('Serial No') ?></th>
                <th scope="col"><?= __('Support End Date') ?></th>
                <th scope="col"><?= __('Setup Date') ?></th>
                <th scope="col"><?= __('M Operation System Id') ?></th>
                <th scope="col"><?= __('M Sqlserver Id') ?></th>
                <th scope="col"><?= __('Admin Pass') ?></th>
                <th scope="col"><?= __('M Product Id') ?></th>
                <th scope="col"><?= __('M Version Id') ?></th>
                <th scope="col"><?= __('Custom') ?></th>
                <th scope="col"><?= __('Connect') ?></th>
                <th scope="col"><?= __('Remote') ?></th>
                <th scope="col"><?= __('Remarks') ?></th>
                <th scope="col"><?= __('Running Flag') ?></th>
                <th scope="col"><?= __('Delete Flag') ?></th>
                <th scope="col"><?= __('M User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mUser->devices as $devices): ?>
            <tr>
                <td><?= h($devices->id) ?></td>
                <td><?= h($devices->center_id) ?></td>
                <td><?= h($devices->m_device_type_id) ?></td>
                <td><?= h($devices->name) ?></td>
                <td><?= h($devices->ip_higher) ?></td>
                <td><?= h($devices->ip_lower) ?></td>
                <td><?= h($devices->reserve_flag) ?></td>
                <td><?= h($devices->security_flag) ?></td>
                <td><?= h($devices->model) ?></td>
                <td><?= h($devices->serial_no) ?></td>
                <td><?= h($devices->support_end_date) ?></td>
                <td><?= h($devices->setup_date) ?></td>
                <td><?= h($devices->m_operation_system_id) ?></td>
                <td><?= h($devices->m_sqlserver_id) ?></td>
                <td><?= h($devices->admin_pass) ?></td>
                <td><?= h($devices->m_product_id) ?></td>
                <td><?= h($devices->m_version_id) ?></td>
                <td><?= h($devices->custom) ?></td>
                <td><?= h($devices->connect) ?></td>
                <td><?= h($devices->remote) ?></td>
                <td><?= h($devices->remarks) ?></td>
                <td><?= h($devices->running_flag) ?></td>
                <td><?= h($devices->delete_flag) ?></td>
                <td><?= h($devices->m_user_id) ?></td>
                <td><?= h($devices->created) ?></td>
                <td><?= h($devices->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Devices', 'action' => 'view', $devices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Devices', 'action' => 'edit', $devices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Devices', 'action' => 'delete', $devices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $devices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related M Customers') ?></h4>
        <?php if (!empty($mUser->m_customers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Full Name') ?></th>
                <th scope="col"><?= __('Remarks') ?></th>
                <th scope="col"><?= __('Delete Flag') ?></th>
                <th scope="col"><?= __('M User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mUser->m_customers as $mCustomers): ?>
            <tr>
                <td><?= h($mCustomers->id) ?></td>
                <td><?= h($mCustomers->name) ?></td>
                <td><?= h($mCustomers->full_name) ?></td>
                <td><?= h($mCustomers->remarks) ?></td>
                <td><?= h($mCustomers->delete_flag) ?></td>
                <td><?= h($mCustomers->m_user_id) ?></td>
                <td><?= h($mCustomers->created) ?></td>
                <td><?= h($mCustomers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MCustomers', 'action' => 'view', $mCustomers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MCustomers', 'action' => 'edit', $mCustomers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MCustomers', 'action' => 'delete', $mCustomers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mCustomers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related M Device Types') ?></h4>
        <?php if (!empty($mUser->m_device_types)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Background Color') ?></th>
                <th scope="col"><?= __('Sort') ?></th>
                <th scope="col"><?= __('Delete Flag') ?></th>
                <th scope="col"><?= __('M User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mUser->m_device_types as $mDeviceTypes): ?>
            <tr>
                <td><?= h($mDeviceTypes->id) ?></td>
                <td><?= h($mDeviceTypes->name) ?></td>
                <td><?= h($mDeviceTypes->background_color) ?></td>
                <td><?= h($mDeviceTypes->sort) ?></td>
                <td><?= h($mDeviceTypes->delete_flag) ?></td>
                <td><?= h($mDeviceTypes->m_user_id) ?></td>
                <td><?= h($mDeviceTypes->created) ?></td>
                <td><?= h($mDeviceTypes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MDeviceTypes', 'action' => 'view', $mDeviceTypes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MDeviceTypes', 'action' => 'edit', $mDeviceTypes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MDeviceTypes', 'action' => 'delete', $mDeviceTypes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mDeviceTypes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related M Operation Systems') ?></h4>
        <?php if (!empty($mUser->m_operation_systems)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Server Flag') ?></th>
                <th scope="col"><?= __('Background Color') ?></th>
                <th scope="col"><?= __('Sort') ?></th>
                <th scope="col"><?= __('Delete Flag') ?></th>
                <th scope="col"><?= __('M User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mUser->m_operation_systems as $mOperationSystems): ?>
            <tr>
                <td><?= h($mOperationSystems->id) ?></td>
                <td><?= h($mOperationSystems->name) ?></td>
                <td><?= h($mOperationSystems->server_flag) ?></td>
                <td><?= h($mOperationSystems->background_color) ?></td>
                <td><?= h($mOperationSystems->sort) ?></td>
                <td><?= h($mOperationSystems->delete_flag) ?></td>
                <td><?= h($mOperationSystems->m_user_id) ?></td>
                <td><?= h($mOperationSystems->created) ?></td>
                <td><?= h($mOperationSystems->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MOperationSystems', 'action' => 'view', $mOperationSystems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MOperationSystems', 'action' => 'edit', $mOperationSystems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MOperationSystems', 'action' => 'delete', $mOperationSystems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mOperationSystems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related M Products') ?></h4>
        <?php if (!empty($mUser->m_products)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Background Color') ?></th>
                <th scope="col"><?= __('Sort') ?></th>
                <th scope="col"><?= __('Delete Flag') ?></th>
                <th scope="col"><?= __('M User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mUser->m_products as $mProducts): ?>
            <tr>
                <td><?= h($mProducts->id) ?></td>
                <td><?= h($mProducts->name) ?></td>
                <td><?= h($mProducts->background_color) ?></td>
                <td><?= h($mProducts->sort) ?></td>
                <td><?= h($mProducts->delete_flag) ?></td>
                <td><?= h($mProducts->m_user_id) ?></td>
                <td><?= h($mProducts->created) ?></td>
                <td><?= h($mProducts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MProducts', 'action' => 'view', $mProducts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MProducts', 'action' => 'edit', $mProducts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MProducts', 'action' => 'delete', $mProducts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mProducts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related M Sqlservers') ?></h4>
        <?php if (!empty($mUser->m_sqlservers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Background Color') ?></th>
                <th scope="col"><?= __('Sort') ?></th>
                <th scope="col"><?= __('Delete Flag') ?></th>
                <th scope="col"><?= __('M User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mUser->m_sqlservers as $mSqlservers): ?>
            <tr>
                <td><?= h($mSqlservers->id) ?></td>
                <td><?= h($mSqlservers->name) ?></td>
                <td><?= h($mSqlservers->background_color) ?></td>
                <td><?= h($mSqlservers->sort) ?></td>
                <td><?= h($mSqlservers->delete_flag) ?></td>
                <td><?= h($mSqlservers->m_user_id) ?></td>
                <td><?= h($mSqlservers->created) ?></td>
                <td><?= h($mSqlservers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MSqlservers', 'action' => 'view', $mSqlservers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MSqlservers', 'action' => 'edit', $mSqlservers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MSqlservers', 'action' => 'delete', $mSqlservers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mSqlservers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related M Versions') ?></h4>
        <?php if (!empty($mUser->m_versions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Background Color') ?></th>
                <th scope="col"><?= __('Sort') ?></th>
                <th scope="col"><?= __('Delete Flag') ?></th>
                <th scope="col"><?= __('M User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mUser->m_versions as $mVersions): ?>
            <tr>
                <td><?= h($mVersions->id) ?></td>
                <td><?= h($mVersions->name) ?></td>
                <td><?= h($mVersions->background_color) ?></td>
                <td><?= h($mVersions->sort) ?></td>
                <td><?= h($mVersions->delete_flag) ?></td>
                <td><?= h($mVersions->m_user_id) ?></td>
                <td><?= h($mVersions->created) ?></td>
                <td><?= h($mVersions->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MVersions', 'action' => 'view', $mVersions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MVersions', 'action' => 'edit', $mVersions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MVersions', 'action' => 'delete', $mVersions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mVersions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
