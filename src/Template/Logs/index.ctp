<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Log[]|\Cake\Collection\CollectionInterface $logs
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Log'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="logs index large-9 medium-8 columns content">
    <h3><?= __('Logs') ?></h3>
    <?= $this->Form->create(null, ['type' => 'get']) ?>
        <fieldset class="search_form">
            <table>
                <tr>
                    <td><?= $this->Form->input('created_from', ['type' => 'text' , 'label' => 'FROM', 'value' => $this->request->query('created_from')]) ?></td>
                    <td><?= $this->Form->input('created_to', ['type' => 'text' , 'label' => 'TO', 'value' => $this->request->query('created_to')]) ?></td>
                    <td style="vertical-align: middle; text-align: center"><?= $this->Form->button('検索') ?>&nbsp;<?= $this->Form->button('クリア', ['type' => 'button', 'onclick' => "reset_form('clear');"]) ?></td>
                </tr>
                <tr>
                    <td colspan="3">※yyyyMMdd形式、またはyyyyMMddhhmm形式で指定（指定外の形式は無視されます）</td>
                </tr>
            </table>
        </fieldset>
    <?= $this->Form->end() ?>
    <?= $this->Form->create(null, ['type' => 'get', 'url' => '/logs/output/']) ?>
    <fieldset>
        <?php
            echo $this->Form->hidden('created_from', ['value' => $this->request->query('created_from')]);
            echo $this->Form->hidden('created_to', ['value' => $this->request->query('created_to')]);
        ?>
        <?= $this->Form->button(__('CSVダウンロード')) ?>
    <?= $this->Form->end() ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" class="th_middle"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="th_short"><?= $this->Paginator->sort('m_user_id') ?></th>
                <th scope="col" class="th_middle"><?= $this->Paginator->sort('class') ?></th>
                <th scope="col" class="th_short_20"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col">content</th>
                <!--<th scope="col" class="actions"><?= __('Actions') ?></th>-->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= h($log->created) ?></td>
                <td><?= $log->has('m_user') ? $log->m_user->name : '' ?></td>
                <td><?= h($log->class) ?></td>
                <td><?= h($log->type) ?></td>
                <td><?= h($log->content) ?></td>
                <!--<td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $log->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $log->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $log->id], ['confirm' => __('Are you sure you want to delete # {0}?', $log->id)]) ?>
                </td>-->
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
