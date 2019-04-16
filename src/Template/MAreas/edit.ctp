<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MArea $mArea
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mArea->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mArea->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List M Areas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List M Prefectures'), ['controller' => 'MPrefectures', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Prefecture'), ['controller' => 'MPrefectures', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mAreas form large-9 medium-8 columns content">
    <?= $this->Form->create($mArea) ?>
    <fieldset>
        <legend><?= __('Edit M Area') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('delete_flag');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
