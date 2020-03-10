<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('is_active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('event_lists_id'); ?></th>
            <th><?= $this->Paginator->sort('activity_lists_id'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($eventActivityLists as $eventActivityList): ?>
        <tr>
            <td><?= $this->Number->format($eventActivityList->id) ?></td>
            <td><?= h($eventActivityList->description) ?></td>
                        <td><?= $eventActivityList->is_active ? __('Yes') : __('No'); ?></td>
                                    <td><?= $this->Number->format($eventActivityList->action_by) ?></td>
            <td><?= h($eventActivityList->created) ?></td>
            <td><?= h($eventActivityList->action_ip) ?></td>
            <td><?= $this->Number->format($eventActivityList->event_lists_id) ?></td>
            <td><?= $this->Number->format($eventActivityList->activity_lists_id) ?></td>
            <td><?= h($eventActivityList->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $eventActivityList->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $eventActivityList->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $eventActivityList->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventActivityList->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
    echo $this->Form->submit('Add eventActivityLists', array('type' => 'button',
        'class' => 'btn  btn-info',
        'onclick' => "location.href='" . $this->Url->build('/eventActivityLists/add') . "'"));
    ?>
</div>