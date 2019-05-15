<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Custom $custom
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Custom'), ['action' => 'edit', $custom->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Custom'), ['action' => 'delete', $custom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $custom->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Customs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Custom'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Devices'), ['controller' => 'Devices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Device'), ['controller' => 'Devices', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="customs view large-9 medium-8 columns content">
    <h3><?= h($custom->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Device') ?></th>
            <td><?= $custom->has('device') ? $this->Html->link($custom->device->name, ['controller' => 'Devices', 'action' => 'view', $custom->device->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Accepted No') ?></th>
            <td><?= h($custom->accepted_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M User') ?></th>
            <td><?= $custom->has('m_user') ? $this->Html->link($custom->m_user->name, ['controller' => 'MUsers', 'action' => 'view', $custom->m_user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($custom->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($custom->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($custom->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete Flag') ?></th>
            <td><?= $custom->delete_flag ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($custom->content)); ?>
    </div>
    <div class="row">
        <h4><?= __('Exe File') ?></h4>
        <?= $this->Text->autoParagraph(h($custom->exe_file)); ?>
    </div>
    <div class="row">
        <h4><?= __('Config File') ?></h4>
        <?= $this->Text->autoParagraph(h($custom->config_file)); ?>
    </div>
    <div class="row">
        <h4><?= __('Hht File') ?></h4>
        <?= $this->Text->autoParagraph(h($custom->hht_file)); ?>
    </div>
    <div class="row">
        <h4><?= __('Db Custom') ?></h4>
        <?= $this->Text->autoParagraph(h($custom->db_custom)); ?>
    </div>
</div>
