<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MCustomer[]|\Cake\Collection\CollectionInterface $mCustomers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= TITLE_CENTER ?></li>
        <li><?= $this->Html->link(__('一覧'), ['controller' => 'Centers', 'action' => 'index']) ?></li>
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= TITLE_DEVICE ?></li>
        <li><?= $this->Html->link(__('一覧'), ['controller' => 'Devices', 'action' => 'index']) ?></li>
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= __('顧客マスタ') ?></li>
        <li><?= $this->Html->link(__('登録'), ['action' => 'add']) ?></li>
    </ul>
    <?php echo $this->element('navi_master', ['own' => 'MCustomers']); ?>
</nav>
<div class="mCustomers index large-9 medium-8 columns content">
    <h3><?= __('M Customers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <!--
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                -->
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('full_name') ?></th>
                <!--
                <th scope="col"><?= $this->Paginator->sort('delete_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                -->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mCustomers as $mCustomer): ?>
            <tr>
                <!--
                <td><?= $this->Number->format($mCustomer->id) ?></td>
                -->
                <td><?= h($mCustomer->name) ?></td>
                <td><?= h($mCustomer->full_name) ?></td>
                <!--
                <td><?= h($mCustomer->delete_flag) ?></td>
                <td><?= $mCustomer->has('m_user') ? $this->Html->link($mCustomer->m_user->name, ['controller' => 'MUsers', 'action' => 'view', $mCustomer->m_user->id]) : '' ?></td>
                <td><?= h($mCustomer->created) ?></td>
                <td><?= h($mCustomer->modified) ?></td>
                -->
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mCustomer->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mCustomer->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mCustomer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mCustomer->id)]) ?>
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
