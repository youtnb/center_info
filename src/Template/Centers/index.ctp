<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Center[]|\Cake\Collection\CollectionInterface $centers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Center'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Customers'), ['controller' => 'MCustomers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Customer'), ['controller' => 'MCustomers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Prefectures'), ['controller' => 'MPrefectures', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Prefecture'), ['controller' => 'MPrefectures', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Devices'), ['controller' => 'Devices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Device'), ['controller' => 'Devices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="centers index large-9 medium-8 columns content">
    <h3><?= __('Centers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('postcode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_prefecture_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('officer') ?></th>
                <th scope="col"><?= $this->Paginator->sort('staff') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shoes_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($centers as $center): ?>
            <tr>
                <td><?= $this->Number->format($center->id) ?></td>
                <td><?= $center->has('m_customer') ? $this->Html->link($center->m_customer->name, ['controller' => 'MCustomers', 'action' => 'view', $center->m_customer->id]) : '' ?></td>
                <td><?= h($center->name) ?></td>
                <td><?= h($center->postcode) ?></td>
                <td><?= $center->has('m_prefecture') ? $this->Html->link($center->m_prefecture->name, ['controller' => 'MPrefectures', 'action' => 'view', $center->m_prefecture->id]) : '' ?></td>
                <td><?= h($center->address) ?></td>
                <td><?= h($center->tel) ?></td>
                <td><?= h($center->officer) ?></td>
                <td><?= h($center->staff) ?></td>
                <td><?= h($center->shoes_flag) ?></td>
                <td><?= h($center->delete_flag) ?></td>
                <td><?= $center->has('m_user') ? $this->Html->link($center->m_user->name, ['controller' => 'MUsers', 'action' => 'view', $center->m_user->id]) : '' ?></td>
                <td><?= h($center->created) ?></td>
                <td><?= h($center->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $center->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $center->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $center->id], ['confirm' => __('Are you sure you want to delete # {0}?', $center->id)]) ?>
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
