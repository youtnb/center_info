<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MPrefecture[]|\Cake\Collection\CollectionInterface $mPrefectures
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New M Prefecture'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Areas'), ['controller' => 'MAreas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Area'), ['controller' => 'MAreas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Centers'), ['controller' => 'Centers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Center'), ['controller' => 'Centers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mPrefectures index large-9 medium-8 columns content">
    <h3><?= __('M Prefectures') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_area_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mPrefectures as $mPrefecture): ?>
            <tr>
                <td><?= $this->Number->format($mPrefecture->id) ?></td>
                <td><?= h($mPrefecture->name) ?></td>
                <td><?= $mPrefecture->has('m_area') ? $this->Html->link($mPrefecture->m_area->name, ['controller' => 'MAreas', 'action' => 'view', $mPrefecture->m_area->id]) : '' ?></td>
                <td><?= h($mPrefecture->delete_flag) ?></td>
                <td><?= h($mPrefecture->created) ?></td>
                <td><?= h($mPrefecture->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mPrefecture->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mPrefecture->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mPrefecture->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mPrefecture->id)]) ?>
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
