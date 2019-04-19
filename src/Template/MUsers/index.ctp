<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MUser[]|\Cake\Collection\CollectionInterface $mUsers
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
        <li class="heading"><?= __('ユーザーマスタ') ?></li>
        <li><?= $this->Html->link(__('登録'), ['action' => 'add']) ?></li>
    </ul>
    <?php echo $this->element('navi_master', ['own' => 'MUsers']); ?>
    </ul>
</nav>
<div class="mUsers index large-9 medium-8 columns content">
    <h3><?= __('M Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('password') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_department_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_role_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mUsers as $mUser): ?>
            <tr>
                <td><?= $this->Number->format($mUser->id) ?></td>
                <td><?= h($mUser->name) ?></td>
                <td><?= h($mUser->email) ?></td>
                <td><?= h($mUser->password) ?></td>
                <td><?= $mUser->has('m_department') ? $this->Html->link($mUser->m_department->name, ['controller' => 'MDepartments', 'action' => 'view', $mUser->m_department->id]) : '' ?></td>
                <td><?= $mUser->has('m_role') ? $this->Html->link($mUser->m_role->name, ['controller' => 'MRoles', 'action' => 'view', $mUser->m_role->id]) : '' ?></td>
                <td><?= h($mUser->delete_flag) ?></td>
                <td><?= h($mUser->created) ?></td>
                <td><?= h($mUser->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mUser->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mUser->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mUser->id)]) ?>
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
