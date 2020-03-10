<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($eventList->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Description') ?></td>
            <td><?= h($eventList->description) ?></td>
        </tr>
        <tr>
            <td><?= __('Action Ip') ?></td>
            <td><?= h($eventList->action_ip) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($eventList->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Event Year') ?></td>
            <td><?= $this->Number->format($eventList->event_year) ?></td>
        </tr>
        <tr>
            <td><?= __('Action By') ?></td>
            <td><?= $this->Number->format($eventList->action_by) ?></td>
        </tr>
        <tr>
            <td><?= __('Registration Start Date') ?></td>
            <td><?= h($eventList->registration_start_date) ?></td>
        </tr>
        <tr>
            <td><?= __('Registration End Date') ?></td>
            <td><?= h($eventList->registration_end_date) ?></td>
        </tr>
        <tr>
            <td><?= __('Event Start Date') ?></td>
            <td><?= h($eventList->event_start_date) ?></td>
        </tr>
        <tr>
            <td><?= __('Event End Date') ?></td>
            <td><?= h($eventList->event_end_date) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($eventList->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($eventList->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Is Active') ?></td>
            <td><?= $eventList->is_active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

