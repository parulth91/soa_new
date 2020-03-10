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
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($eventActivityList->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Action By') ?></td>
            <td><?= $this->Number->format($eventActivityList->action_by) ?></td>
        </tr>
        <tr>
            <td><?= __('Event Lists Id') ?></td>
            <td><?= $this->Number->format($eventActivityList->event_lists_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Activity Lists Id') ?></td>
            <td><?= $this->Number->format($eventActivityList->activity_lists_id) ?></td>
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
            <td><?= __('Is Active') ?></td>
            <td><?= $eventActivityList->is_active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

