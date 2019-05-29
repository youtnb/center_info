<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Center[]|\Cake\Collection\CollectionInterface $centers
 */
?>
<script type="text/javascript">
jQuery(function($)
{
    // 地域選択時、都道府県選択クリア
    $('#m-area-id').change(function()
    {
        $('#m-prefecture-id').val('');
    });
});
</script>
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
    <h3><?= __('拠点情報一覧') ?></h3>
    <?= $this->Form->create(null, ['type' => 'get']) ?>
        <fieldset class="search_form">
            <table>
                <tr>
                    <td><?= $this->Form->input('m_customer_id', ['type' => 'select' ,'options' => $mCustomers, 'empty' => '選択してください', 'label' => '顧客', 'value' => $this->request->query('m_customer_id')]) ?></td>
                    <td><?= $this->Form->input('m_area_id', ['type' => 'select' ,'options' => $mAreas, 'empty' => '選択してください', 'label' => '地域', 'value' => $this->request->query('m_area_id')]) ?></td>
                    <td><?= $this->Form->input('m_prefecture_id', ['type' => 'select' ,'options' => $mPrefectures, 'empty' => '選択してください', 'label' => '都道府県', 'value' => $this->request->query('m_prefecture_id')]) ?></td>
                    <td rowspan="2" style="vertical-align: middle; text-align: center"><?= $this->Form->button('検索') ?>&nbsp;<?= $this->Form->button('クリア', ['type' => 'button', 'onclick' => 'reset_form();']) ?></td>
                </tr>
                <tr>
                    <td colspan="2"><?= $this->Form->input('name', ['type' => 'text' , 'label' => '拠点', 'value' => $this->request->query('name')]) ?></td>
                    <td style="vertical-align: middle; text-align: center"><?= $this->Form->input('delete_flag', ['type' => 'checkbox' , 'label' => '削除済みも表示する', 'checked' => $this->request->query('delete_flag')?'checked':'']) ?></td>
                </tr>
            </table>
        </fieldset>
    <?= $this->Form->end() ?>
    <div class="list_table">
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" class="th_customer"><?= $this->Paginator->sort('m_customer_id', '顧客') ?></th>
                <th scope="col" class="th_center"><?= $this->Paginator->sort('name', '拠点') ?></th>
                <th scope="col" class="th_min"><?= $this->Paginator->sort('postcode', '〒') ?></th>
                <th scope="col" class="th_short"><?= $this->Paginator->sort('m_prefecture_id', '都道府県') ?></th>
                <th scope="col" class="th_large"><?= $this->Paginator->sort('address', '住所') ?></th>
                <th scope="col" class="th_flag"><?= $this->Paginator->sort('delete_flag', '削除') ?></th>
                <th scope="col" class="actions th_actions"><?= __('') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($centers as $center): ?>
            <tr class="clickable <?= $center->delete_flag?'delete_content':'' ?>" data-href="<?= $this->Url->build(['controller' => 'Centers', 'action' => 'view', $center->id]) ?>">
                <td><?= $center->has('m_customer') ? $center->m_customer->name : '' ?></td>
                <td><?= h($center->name) ?></td>
                <td><?= h($center->postcode) ?></td>
                <td><?= $center->has('m_prefecture') ? $center->m_prefecture->name : '' ?></td>
                <td><?= h($center->address) ?></td>
                <td style="text-align: center"><?php if($center->delete_flag){ echo LIST_CHECK_MARK; } ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('閲覧'), ['action' => 'view', $center->id]) ?>
                    /
                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $center->id]) ?><!--
                    /
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $center->id], ['confirm' => __(DELETE_CONFIRM.' # {0}?', $center->id)]) ?>-->
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
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
