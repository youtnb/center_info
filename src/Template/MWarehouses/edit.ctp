<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MWarehouse $mWarehouse
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mWarehouse->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mWarehouse->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List M Warehouses'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="mWarehouses form large-9 medium-8 columns content">
    <?= $this->Form->create($mWarehouse) ?>
    <fieldset>
        <legend><?= __('Edit M Warehouse') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('icon');
            echo $this->Form->control('center_id_1', ['options' => $centers, 'empty' => '選択してください']);
            echo $this->Form->control('center_id_2', ['options' => $centers, 'empty' => '選択してください']);
            echo $this->Form->control('center_id_3', ['options' => $centers, 'empty' => '選択してください']);
            echo $this->Form->control('center_id_4', ['options' => $centers, 'empty' => '選択してください']);
            echo $this->Form->control('center_id_5', ['options' => $centers, 'empty' => '選択してください']);
            echo $this->Form->control('remarks');
            echo $this->Form->hidden('m_user_id', ['value' => $this->request->session()->read('Auth.User.id')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
