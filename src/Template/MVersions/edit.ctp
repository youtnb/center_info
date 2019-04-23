<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MVersion $mVersion
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mVersion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mVersion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List M Versions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Devices'), ['controller' => 'Devices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Device'), ['controller' => 'Devices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mVersions form large-9 medium-8 columns content">
    <?= $this->Form->create($mVersion) ?>
    <fieldset>
        <legend><?= __('Edit M Version') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('background_color');
            echo $this->Form->control('sort');
            echo $this->Form->control('delete_flag');
            echo $this->Form->hidden('m_user_id', ['value' => $this->request->session()->read('Auth.User.id')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
