<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Custom[]|\Cake\Collection\CollectionInterface $customs
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Custom'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Devices'), ['controller' => 'Devices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Device'), ['controller' => 'Devices', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customs index large-9 medium-8 columns content">
    <h3><?= __('Customs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('device_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('accepted_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customs as $custom): ?>
            <tr>
                <td><?= $this->Number->format($custom->id) ?></td>
                <td><?= $custom->has('device') ? $this->Html->link($custom->device->name, ['controller' => 'Devices', 'action' => 'view', $custom->device->id]) : '' ?></td>
                <td><?= h($custom->accepted_no) ?></td>
                <td><?= h($custom->delete_flag) ?></td>
                <td><?= $custom->has('m_user') ? $this->Html->link($custom->m_user->name, ['controller' => 'MUsers', 'action' => 'view', $custom->m_user->id]) : '' ?></td>
                <td><?= h($custom->created) ?></td>
                <td><?= h($custom->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $custom->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $custom->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $custom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $custom->id)]) ?>
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
