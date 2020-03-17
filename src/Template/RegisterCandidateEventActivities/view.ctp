<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($registerCandidateEventActivity->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Event Activity List') ?></td>
            <td><?= $registerCandidateEventActivity->has('event_activity_list') ? $this->Html->link($registerCandidateEventActivity->event_activity_list->description, ['controller' => 'EventActivityLists', 'action' => 'view', $registerCandidateEventActivity->event_activity_list->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Full Name') ?></td>
            <td><?= h($registerCandidateEventActivity->full_name) ?></td>
        </tr>
        <tr>
            <td><?= __('Gender List') ?></td>
            <td><?= $registerCandidateEventActivity->has('gender_list') ? $this->Html->link($registerCandidateEventActivity->gender_list->description, ['controller' => 'GenderLists', 'action' => 'view', $registerCandidateEventActivity->gender_list->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Registration Number') ?></td>
            <td><?= h($registerCandidateEventActivity->registration_number) ?></td>
        </tr>
        <tr>
            <td><?= __('Event Team Detail') ?></td>
            <td><?= $registerCandidateEventActivity->has('event_team_detail') ? $this->Html->link($registerCandidateEventActivity->event_team_detail->description, ['controller' => 'EventTeamDetails', 'action' => 'view', $registerCandidateEventActivity->event_team_detail->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Action Ip') ?></td>
            <td><?= h($registerCandidateEventActivity->action_ip) ?></td>
        </tr>
        <tr>
            <td><?= __('State List') ?></td>
            <td><?= $registerCandidateEventActivity->has('state_list') ? $this->Html->link($registerCandidateEventActivity->state_list->description, ['controller' => 'StateLists', 'action' => 'view', $registerCandidateEventActivity->state_list->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($registerCandidateEventActivity->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Weight') ?></td>
            <td><?= $this->Number->format($registerCandidateEventActivity->weight) ?></td>
        </tr>
        <tr>
            <td><?= __('Age') ?></td>
            <td><?= $this->Number->format($registerCandidateEventActivity->age) ?></td>
        </tr>
        <tr>
            <td><?= __('Action By') ?></td>
            <td><?= $this->Number->format($registerCandidateEventActivity->action_by) ?></td>
        </tr>
        <tr>
            <td><?= __('Result Status List Id') ?></td>
            <td><?= $this->Number->format($registerCandidateEventActivity->result_status_list_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Dob') ?></td>
            <td><?= h($registerCandidateEventActivity->dob) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($registerCandidateEventActivity->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($registerCandidateEventActivity->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Event Qualifying Status') ?></td>
            <td><?= $registerCandidateEventActivity->event_qualifying_status ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('Attendance Status') ?></td>
            <td><?= $registerCandidateEventActivity->attendance_status ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('Certificate Download Status') ?></td>
            <td><?= $registerCandidateEventActivity->certificate_download_status ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('Active') ?></td>
            <td><?= $registerCandidateEventActivity->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

