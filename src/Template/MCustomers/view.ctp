<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MCustomer $mCustomer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit M Customer'), ['action' => 'edit', $mCustomer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete M Customer'), ['action' => 'delete', $mCustomer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mCustomer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List M Customers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Customer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Centers'), ['controller' => 'Centers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Center'), ['controller' => 'Centers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mCustomers view large-9 medium-8 columns content">
    <h3><?= h($mCustomer->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($mCustomer->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Full Name') ?></th>
            <td><?= h($mCustomer->full_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M User') ?></th>
            <td><?= $mCustomer->has('m_user') ? $this->Html->link($mCustomer->m_user->name, ['controller' => 'MUsers', 'action' => 'view', $mCustomer->m_user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mCustomer->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mCustomer->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mCustomer->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete Flag') ?></th>
            <td><?= $mCustomer->delete_flag ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Remarks') ?></h4>
        <?= $this->Text->autoParagraph(h($mCustomer->remarks)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Centers') ?></h4>
        <?php if (!empty($mCustomer->centers)): ?>
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
            <?php foreach ($mCustomer->centers as $centers): ?>
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
</div>
