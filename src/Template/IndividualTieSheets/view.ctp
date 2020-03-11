<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($individualTieSheet->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Register Candidate Event Activity') ?></td>
            <td><?= $individualTieSheet->has('register_candidate_event_activity') ? $this->Html->link($individualTieSheet->register_candidate_event_activity->description, ['controller' => 'RegisterCandidateEventActivities', 'action' => 'view', $individualTieSheet->register_candidate_event_activity->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Event Activity List') ?></td>
            <td><?= $individualTieSheet->has('event_activity_list') ? $this->Html->link($individualTieSheet->event_activity_list->description, ['controller' => 'EventActivityLists', 'action' => 'view', $individualTieSheet->event_activity_list->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Action Ip') ?></td>
            <td><?= h($individualTieSheet->action_ip) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($individualTieSheet->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Register Candidate Event Activity Id') ?></td>
            <td><?= $this->Number->format($individualTieSheet->register_candidate_event_activity_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Opponent Register Candidate Event Activity Id') ?></td>
            <td><?= $this->Number->format($individualTieSheet->opponent_register_candidate_event_activity_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Match Number') ?></td>
            <td><?= $this->Number->format($individualTieSheet->match_number) ?></td>
        </tr>
        <tr>
            <td><?= __('Action By') ?></td>
            <td><?= $this->Number->format($individualTieSheet->action_by) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($individualTieSheet->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($individualTieSheet->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Active') ?></td>
            <td><?= $individualTieSheet->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

