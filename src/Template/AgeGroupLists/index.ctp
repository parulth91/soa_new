<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('minimum_age'); ?></th>
            <th><?= $this->Paginator->sort('maximum_age'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ageGroupLists as $ageGroupList): ?>
        <tr>
            <td><?= $this->Number->format($ageGroupList->id) ?></td>
            <td><?= h($ageGroupList->description) ?></td>
            <td><?= $this->Number->format($ageGroupList->minimum_age) ?></td>
            <td><?= $this->Number->format($ageGroupList->maximum_age) ?></td>
                        <td><?= $ageGroupList->active ? __('Yes') : __('No'); ?></td>
                                    <td><?= $this->Number->format($ageGroupList->action_by) ?></td>
            <td><?= h($ageGroupList->created) ?></td>
            <td><?= h($ageGroupList->action_ip) ?></td>
            <td><?= h($ageGroupList->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $ageGroupList->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $ageGroupList->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $ageGroupList->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ageGroupList->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
          <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
      
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>

<div>
    <?php
    echo $this->Form->submit('Add ageGroupLists', array('type' => 'button',
        'class' => 'btn  btn-info',
        'onclick' => "location.href='" . $this->Url->build('/ageGroupLists/add') . "'"));
    ?>
</div>