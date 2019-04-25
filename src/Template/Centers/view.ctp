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
        <li><?= $this->Html->link(__('登録'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('編集'), ['action' => 'edit', $center->id]) ?> </li>
        <li><?= $this->Form->postLink(__('削除'), ['action' => 'delete', $center->id], ['confirm' => __(DELETE_CONFIRM.' # {0}?', $center->id)]) ?> </li>
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
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('M Customer') ?></th>
            <td><?= $center->has('m_customer') ? $this->Html->link($center->m_customer->name, ['controller' => 'MCustomers', 'action' => 'view', $center->m_customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($center->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Postcode') ?></th>
            <td><?= h($center->postcode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M Prefecture') ?></th>
            <td><?= $center->has('m_prefecture') ? $this->Html->link($center->m_prefecture->name, ['controller' => 'MPrefectures', 'action' => 'view', $center->m_prefecture->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($center->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tel') ?></th>
            <td><?= h($center->tel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Officer') ?></th>
            <td><?= h($center->officer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Staff') ?></th>
            <td><?= h($center->staff) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M User') ?></th>
            <td><?= $center->has('m_user') ? $this->Html->link($center->m_user->name, ['controller' => 'MUsers', 'action' => 'view', $center->m_user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($center->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($center->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($center->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Thermo Dry Flag') ?></th>
            <td><?= $center->thermo_dry_flag ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Thermo Dry Flag') ?></th>
            <td><?= $center->thermo_chilled_flag ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Thermo Dry Flag') ?></th>
            <td><?= $center->thermo_frozen_flag ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shoes Flag') ?></th>
            <td><?= $center->shoes_flag ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete Flag') ?></th>
            <td><?= $center->delete_flag ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Access') ?></h4>
        <?= $this->Text->autoParagraph(h($center->access)); ?>
    </div>
    <div class="row">
        <h4><?= __('Job') ?></h4>
        <?= $this->Text->autoParagraph(h($center->job)); ?>
    </div>
    <div class="row">
        <h4><?= __('Remarks') ?></h4>
        <?= $this->Text->autoParagraph(h($center->remarks)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Devices') ?></h4>
        <?php if (!empty($center->devices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('M Device Type Id') ?></th>
                <th scope="col"><?= __('Accepted No') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Ip Higher') ?></th>
                <th scope="col"><?= __('Ip Lower') ?></th>
                <th scope="col"><?= __('Reserve Flag') ?></th>
                <th scope="col"><?= __('Setup Date') ?></th>
                <th scope="col"><?= __('Connect') ?></th>
                <th scope="col"><?= __('Remote') ?></th>
                <th scope="col"><?= __('Delete Flag') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($center->devices as $devices): ?>
            <tr>
                <td><?= h($devices->m_device_type_id) ?></td>
                <td><?= h($devices->accepted_no) ?></td>
                <td><?= h($devices->name) ?></td>
                <td><?= h($devices->ip_higher) ?></td>
                <td><?= h($devices->ip_lower) ?></td>
                <td><?= h($devices->reserve_flag) ?></td>
                <td><?= h($devices->setup_date) ?></td>
                <td><?= h($devices->connect) ?></td>
                <td><?= h($devices->remote) ?></td>
                <td><?= h($devices->delete_flag) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('閲覧'), ['controller' => 'Devices', 'action' => 'view', $devices->id]) ?>
                    /
                    <?= $this->Html->link(__('編集'), ['controller' => 'Devices', 'action' => 'edit', $devices->id]) ?>
                    /
                    <?= $this->Form->postLink(__('削除'), ['controller' => 'Devices', 'action' => 'delete', $devices->id], ['confirm' => __(DELETE_CONFIRM.' # {0}?', $devices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
