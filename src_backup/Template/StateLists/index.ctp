<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('country_list_id'); ?></th>
            <th><?= $this->Paginator->sort('is_active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($stateLists as $stateList): ?>
        <tr>
            <td><?= $this->Number->format($stateList->id) ?></td>
            <td><?= h($stateList->description) ?></td>
            <td>
                <?= $stateList->has('country_list') ? $this->Html->link($stateList->country_list->description, ['controller' => 'CountryLists', 'action' => 'view', $stateList->country_list->id]) : '' ?>
            </td>
                        <td><?= $stateList->is_active ? __('Yes') : __('No'); ?></td>
                                    <td><?= $this->Number->format($stateList->action_by) ?></td>
            <td><?= h($stateList->created) ?></td>
            <td><?= h($stateList->action_ip) ?></td>
            <td><?= h($stateList->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $stateList->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $stateList->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $stateList->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stateList->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
    echo $this->Form->submit('Add stateLists', array('type' => 'button',
        'class' => 'btn  btn-info',
        'onclick' => "location.href='" . $this->Url->build('/stateLists/add') . "'"));
    ?>
</div>