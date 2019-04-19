<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MOperationSystem[]|\Cake\Collection\CollectionInterface $mOperationSystems
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
        <li class="heading"><?= __('OS種別マスタ') ?></li>
        <li><?= $this->Html->link(__('登録'), ['action' => 'add']) ?></li>
    </ul>
    <?php echo $this->element('navi_master', ['own' => 'MOperationSystems']); ?>
</nav>
<div class="mOperationSystems index large-9 medium-8 columns content">
    <h3><?= __('M Operation Systems') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('server_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('background_color') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sort') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mOperationSystems as $mOperationSystem): ?>
            <tr>
                <td><?= $this->Number->format($mOperationSystem->id) ?></td>
                <td><?= h($mOperationSystem->name) ?></td>
                <td><?= h($mOperationSystem->server_flag) ?></td>
                <td><?= h($mOperationSystem->background_color) ?></td>
                <td><?= $this->Number->format($mOperationSystem->sort) ?></td>
                <td><?= h($mOperationSystem->delete_flag) ?></td>
                <td><?= $mOperationSystem->has('m_user') ? $this->Html->link($mOperationSystem->m_user->name, ['controller' => 'MUsers', 'action' => 'view', $mOperationSystem->m_user->id]) : '' ?></td>
                <td><?= h($mOperationSystem->created) ?></td>
                <td><?= h($mOperationSystem->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mOperationSystem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mOperationSystem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mOperationSystem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mOperationSystem->id)]) ?>
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
