<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MDeviceType[]|\Cake\Collection\CollectionInterface $mDeviceTypes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New M Device Type'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Devices'), ['controller' => 'Devices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Device'), ['controller' => 'Devices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mDeviceTypes index large-9 medium-8 columns content">
    <h3><?= __('M Device Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('background_color') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sort') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mDeviceTypes as $mDeviceType): ?>
            <tr>
                <td><?= $this->Number->format($mDeviceType->id) ?></td>
                <td><?= h($mDeviceType->name) ?></td>
                <td><?= h($mDeviceType->background_color) ?></td>
                <td><?= $this->Number->format($mDeviceType->sort) ?></td>
                <td><?= h($mDeviceType->delete_flag) ?></td>
                <td><?= $mDeviceType->has('m_user') ? $this->Html->link($mDeviceType->m_user->name, ['controller' => 'MUsers', 'action' => 'view', $mDeviceType->m_user->id]) : '' ?></td>
                <td><?= h($mDeviceType->created) ?></td>
                <td><?= h($mDeviceType->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mDeviceType->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mDeviceType->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mDeviceType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mDeviceType->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
