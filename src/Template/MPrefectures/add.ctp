<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MPrefecture $mPrefecture
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List M Prefectures'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List M Areas'), ['controller' => 'MAreas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Area'), ['controller' => 'MAreas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Centers'), ['controller' => 'Centers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Center'), ['controller' => 'Centers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mPrefectures form large-9 medium-8 columns content">
    <?= $this->Form->create($mPrefecture) ?>
    <fieldset>
        <legend><?= __('Add M Prefecture') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('m_area_id', ['options' => $mAreas]);
            echo $this->Form->control('delete_flag');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
