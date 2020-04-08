<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MRole $mRole
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit M Role'), ['action' => 'edit', $mRole->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete M Role'), ['action' => 'delete', $mRole->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mRole->id)]) ?> </li>
        <li><?= $this->Html->link(__('List M Roles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Role'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mRoles view large-9 medium-8 columns content">
    <h3><?= h($mRole->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($mRole->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mRole->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mRole->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mRole->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related M Users') ?></h4>
        <?php if (!empty($mRole->m_users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('M Role Id') ?></th>
                <th scope="col"><?= __('Delete Flag') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mRole->m_users as $mUsers): ?>
            <tr>
                <td><?= h($mUsers->id) ?></td>
                <td><?= h($mUsers->name) ?></td>
                <td><?= h($mUsers->email) ?></td>
                <td><?= h($mUsers->password) ?></td>
                <td><?= h($mUsers->m_role_id) ?></td>
                <td><?= h($mUsers->delete_flag) ?></td>
                <td><?= h($mUsers->created) ?></td>
                <td><?= h($mUsers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MUsers', 'action' => 'view', $mUsers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MUsers', 'action' => 'edit', $mUsers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MUsers', 'action' => 'delete', $mUsers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mUsers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
