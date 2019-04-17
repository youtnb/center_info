<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MDepartment[]|\Cake\Collection\CollectionInterface $mDepartments
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New M Department'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mDepartments index large-9 medium-8 columns content">
    <h3><?= __('M Departments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sort') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mDepartments as $mDepartment): ?>
            <tr>
                <td><?= $this->Number->format($mDepartment->id) ?></td>
                <td><?= h($mDepartment->name) ?></td>
                <td><?= $this->Number->format($mDepartment->sort) ?></td>
                <td><?= h($mDepartment->created) ?></td>
                <td><?= h($mDepartment->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mDepartment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mDepartment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mDepartment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mDepartment->id)]) ?>
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
