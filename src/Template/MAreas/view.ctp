<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MArea $mArea
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit M Area'), ['action' => 'edit', $mArea->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete M Area'), ['action' => 'delete', $mArea->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mArea->id)]) ?> </li>
        <li><?= $this->Html->link(__('List M Areas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Area'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List M Prefectures'), ['controller' => 'MPrefectures', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Prefecture'), ['controller' => 'MPrefectures', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mAreas view large-9 medium-8 columns content">
    <h3><?= h($mArea->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($mArea->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mArea->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mArea->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mArea->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete Flag') ?></th>
            <td><?= $mArea->delete_flag ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related M Prefectures') ?></h4>
        <?php if (!empty($mArea->m_prefectures)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('M Area Id') ?></th>
                <th scope="col"><?= __('Delete Flag') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mArea->m_prefectures as $mPrefectures): ?>
            <tr>
                <td><?= h($mPrefectures->id) ?></td>
                <td><?= h($mPrefectures->name) ?></td>
                <td><?= h($mPrefectures->m_area_id) ?></td>
                <td><?= h($mPrefectures->delete_flag) ?></td>
                <td><?= h($mPrefectures->created) ?></td>
                <td><?= h($mPrefectures->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MPrefectures', 'action' => 'view', $mPrefectures->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MPrefectures', 'action' => 'edit', $mPrefectures->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MPrefectures', 'action' => 'delete', $mPrefectures->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mPrefectures->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
