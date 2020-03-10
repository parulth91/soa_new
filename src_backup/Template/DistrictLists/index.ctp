<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('state_list_id'); ?></th>
            <th><?= $this->Paginator->sort('is_active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($districtLists as $districtList): ?>
        <tr>
            <td><?= $this->Number->format($districtList->id) ?></td>
            <td><?= h($districtList->description) ?></td>
            <td>
                <?= $districtList->has('state_list') ? $this->Html->link($districtList->state_list->description, ['controller' => 'StateLists', 'action' => 'view', $districtList->state_list->id]) : '' ?>
            </td>
                        <td><?= $districtList->is_active ? __('Yes') : __('No'); ?></td>
                                    <td><?= $this->Number->format($districtList->action_by) ?></td>
            <td><?= h($districtList->created) ?></td>
            <td><?= h($districtList->action_ip) ?></td>
            <td><?= h($districtList->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $districtList->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $districtList->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $districtList->id], ['confirm' => __('Are you sure you want to delete # {0}?', $districtList->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
    echo $this->Form->submit('Add districtLists', array('type' => 'button',
        'class' => 'btn  btn-info',
        'onclick' => "location.href='" . $this->Url->build('/districtLists/add') . "'"));
    ?>
</div>