<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($eventActivityList->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Description') ?></td>
            <td><?= h($eventActivityList->description) ?></td>
        </tr>
        <tr>
            <td><?= __('Action Ip') ?></td>
            <td><?= h($eventActivityList->action_ip) ?></td>
        </tr>
        <tr>
            <td><?= __('Event List') ?></td>
            <td><?= $eventActivityList->has('event_list') ? $this->Html->link($eventActivityList->event_list->description, ['controller' => 'EventLists', 'action' => 'view', $eventActivityList->event_list->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Activity List') ?></td>
            <td><?= $eventActivityList->has('activity_list') ? $this->Html->link($eventActivityList->activity_list->description, ['controller' => 'ActivityLists', 'action' => 'view', $eventActivityList->activity_list->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($eventActivityList->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Action By') ?></td>
            <td><?= $this->Number->format($eventActivityList->action_by) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($eventActivityList->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($eventActivityList->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Active') ?></td>
            <td><?= $eventActivityList->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

