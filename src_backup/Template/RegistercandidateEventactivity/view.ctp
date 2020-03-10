<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($registercandidateEventactivity->registration_id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Event Activity List') ?></td>
            <td><?= $registercandidateEventactivity->has('event_activity_list') ? $this->Html->link($registercandidateEventactivity->event_activity_list->description, ['controller' => 'EventActivityLists', 'action' => 'view', $registercandidateEventactivity->event_activity_list->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Registration Id') ?></td>
            <td><?= $this->Number->format($registercandidateEventactivity->registration_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Weight') ?></td>
            <td><?= $this->Number->format($registercandidateEventactivity->weight) ?></td>
        </tr>
        <tr>
            <td><?= __('Age') ?></td>
            <td><?= $this->Number->format($registercandidateEventactivity->age) ?></td>
        </tr>
    </table>
</div>

