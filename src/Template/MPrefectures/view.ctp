<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MPrefecture $mPrefecture
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit M Prefecture'), ['action' => 'edit', $mPrefecture->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete M Prefecture'), ['action' => 'delete', $mPrefecture->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mPrefecture->id)]) ?> </li>
        <li><?= $this->Html->link(__('List M Prefectures'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Prefecture'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List M Areas'), ['controller' => 'MAreas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Area'), ['controller' => 'MAreas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Centers'), ['controller' => 'Centers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Center'), ['controller' => 'Centers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mPrefectures view large-9 medium-8 columns content">
    <h3><?= h($mPrefecture->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($mPrefecture->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M Area') ?></th>
            <td><?= $mPrefecture->has('m_area') ? $this->Html->link($mPrefecture->m_area->name, ['controller' => 'MAreas', 'action' => 'view', $mPrefecture->m_area->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mPrefecture->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mPrefecture->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mPrefecture->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete Flag') ?></th>
            <td><?= $mPrefecture->delete_flag ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Centers') ?></h4>
        <?php if (!empty($mPrefecture->centers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Customer Id') ?></th>
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
            <?php foreach ($mPrefecture->centers as $centers): ?>
            <tr>
                <td><?= h($centers->id) ?></td>
                <td><?= h($centers->customer_id) ?></td>
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
