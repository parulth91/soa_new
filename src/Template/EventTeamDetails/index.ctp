<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('event_activity_list_id'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th><?= $this->Paginator->sort('state_list_id'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($eventTeamDetails as $eventTeamDetail): ?>
        <tr>
            <td><?= $this->Number->format($eventTeamDetail->id) ?></td>
            <td><?= h($eventTeamDetail->description) ?></td>
            <td>
                <?= $eventTeamDetail->has('event_activity_list') ? $this->Html->link($eventTeamDetail->event_activity_list->description, ['controller' => 'EventActivityLists', 'action' => 'view', $eventTeamDetail->event_activity_list->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($eventTeamDetail->action_by) ?></td>
            <td><?= h($eventTeamDetail->created) ?></td>
            <td><?= h($eventTeamDetail->action_ip) ?></td>
            <td><?= h($eventTeamDetail->modified) ?></td>
            <td><?= $this->Number->format($eventTeamDetail->state_list_id) ?></td>
                        <td><?= $eventTeamDetail->active ? __('Yes') : __('No'); ?></td>
                                    <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $eventTeamDetail->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $eventTeamDetail->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $eventTeamDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventTeamDetail->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
    echo $this->Form->submit('Add eventTeamDetails', array('type' => 'button',
        'class' => 'btn  btn-info',
        'onclick' => "location.href='" . $this->Url->build('/eventTeamDetails/add') . "'"));
    ?>
</div>