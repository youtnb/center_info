<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Center[]|\Cake\Collection\CollectionInterface $centers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= TITLE_CENTER ?></li>
        <li><?= $this->Html->link(__('登録'), ['action' => 'add']) ?></li>
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= TITLE_DEVICE ?></li>
        <li><?= $this->Html->link(__('一覧'), ['controller' => 'Devices', 'action' => 'index']) ?></li>
    </ul>
    <?php echo $this->element('navi_master'); ?>
</nav>
<div class="centers index large-9 medium-8 columns content">
    <h3><?= __('拠点情報 一覧') ?></h3>
    <?= $this->Form->create() ?>
        <fieldset>
            <?= $this->Form->input('m_customer_id', ['type' => 'select' ,'options' => $mCustomers, 'empty' => '選択してください', 'label' => '顧客']) ?>
            <?= $this->Form->input('m_prefecture_id', ['type' => 'select' ,'options' => $mPrefectures, 'empty' => '選択してください', 'label' => '都道府県']) ?>
            <?= $this->Form->button('送信') ?>
        </fieldset>
    <?= $this->Form->end() ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" style="width:15%;"><?= $this->Paginator->sort('m_customer_id', '顧客') ?></th>
                <th scope="col" style="width:20%;"><?= $this->Paginator->sort('name', '拠点名') ?></th>
                <th scope="col" style="width:8%;"><?= $this->Paginator->sort('postcode', '〒') ?></th>
                <th scope="col" style="width:8%;"><?= $this->Paginator->sort('m_prefecture_id', '都道府県') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address', '住所') ?></th>
                <th scope="col" style="width:5%;"><?= $this->Paginator->sort('delete_flag', '削除') ?></th>
                <th scope="col" style="width:13%;" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($centers as $center): ?>
            <tr>
                <td><?= $center->has('m_customer') ? $this->Html->link($center->m_customer->name, ['controller' => 'MCustomers', 'action' => 'view', $center->m_customer->id]) : '' ?></td>
                <td><?= h($center->name) ?></td>
                <td><?= h($center->postcode) ?></td>
                <td><?= $center->has('m_prefecture') ? $this->Html->link($center->m_prefecture->name, ['controller' => 'MPrefectures', 'action' => 'view', $center->m_prefecture->id]) : '' ?></td>
                <td><?= h($center->address) ?></td>
                <td><?= h($center->delete_flag) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('閲覧'), ['action' => 'view', $center->id]) ?>
                    /
                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $center->id]) ?>
                    /
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $center->id], ['confirm' => __(DELETE_CONFIRM.' # {0}?', $center->id)]) ?>
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
