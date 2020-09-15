<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MWarehouse $mWarehouse
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit M Warehouse'), ['action' => 'edit', $mWarehouse->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete M Warehouse'), ['action' => 'delete', $mWarehouse->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mWarehouse->id)]) ?> </li>
        <li><?= $this->Html->link(__('List M Warehouses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Warehouse'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mWarehouses view large-9 medium-8 columns content">
    <h3><?= h($mWarehouse->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($mWarehouse->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Icon') ?></th>
            <td><?= h($mWarehouse->icon) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M User') ?></th>
            <td><?= $mWarehouse->has('m_user') ? $this->Html->link($mWarehouse->m_user->name, ['controller' => 'MUsers', 'action' => 'view', $mWarehouse->m_user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mWarehouse->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Center Id 1') ?></th>
            <td><?= $this->Number->format($mWarehouse->center_id_1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Center Id 2') ?></th>
            <td><?= $this->Number->format($mWarehouse->center_id_2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Center Id 3') ?></th>
            <td><?= $this->Number->format($mWarehouse->center_id_3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Center Id 4') ?></th>
            <td><?= $this->Number->format($mWarehouse->center_id_4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Center Id 5') ?></th>
            <td><?= $this->Number->format($mWarehouse->center_id_5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mWarehouse->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mWarehouse->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Remarks') ?></h4>
        <?= $this->Text->autoParagraph(h($mWarehouse->remarks)); ?>
    </div>
</div>
