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
            <td><?= __('Registration Fees') ?></td>
            <td><?= $this->Number->format($eventActivityList->registration_fees) ?></td>
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

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related EventTeamDetails') ?></h3>
    </div>
    <?php if (!empty($eventActivityList->event_team_details)): ?>
        <table class="table table-striped">
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
            <?php foreach ($eventActivityList->event_team_details as $eventTeamDetails): ?>
                <tr>
                    <td><?= h($eventTeamDetails->id) ?></td>
                    <td><?= h($eventTeamDetails->description) ?></td>
                    <td><?= h($eventTeamDetails->event_activity_list_id) ?></td>
                    <td><?= h($eventTeamDetails->action_by) ?></td>
                    <td><?= h($eventTeamDetails->created) ?></td>
                    <td><?= h($eventTeamDetails->action_ip) ?></td>
                    <td><?= h($eventTeamDetails->modified) ?></td>
                    <td><?= h($eventTeamDetails->state_list_id) ?></td>
                    <td><?= h($eventTeamDetails->active) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'EventTeamDetails', 'action' => 'view', $eventTeamDetails->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'EventTeamDetails', 'action' => 'edit', $eventTeamDetails->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'EventTeamDetails', 'action' => 'delete', $eventTeamDetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventTeamDetails->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related EventTeamDetails</p>
    <?php endif; ?>
</div>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related RegisterCandidateEventActivities') ?></h3>
    </div>
    <?php if (!empty($eventActivityList->register_candidate_event_activities)): ?>
        <table class="table table-striped">
               <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('event_activity_list_id'); ?></th>
            <th><?= $this->Paginator->sort('full_name'); ?></th>
            <th><?= $this->Paginator->sort('dob'); ?></th>
            <th><?= $this->Paginator->sort('gender_list_id'); ?></th>
            <th><?= $this->Paginator->sort('registration_number'); ?></th>
            <th><?= $this->Paginator->sort('event_team_detail_id'); ?></th>
            <th><?= $this->Paginator->sort('weight'); ?></th>
            <th><?= $this->Paginator->sort('age'); ?></th>
            <th><?= $this->Paginator->sort('event_qualifying_status'); ?></th>
            <th><?= $this->Paginator->sort('attendance_status'); ?></th>
            <th><?= $this->Paginator->sort('certificate_download_status'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th><?= $this->Paginator->sort('state_list_id'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
           
            <tbody>
            <?php foreach ($eventActivityList->register_candidate_event_activities as $registerCandidateEventActivities): ?>
                <tr>
                    <td><?= h($registerCandidateEventActivities->id) ?></td>
                    <td><?= h($registerCandidateEventActivities->event_activity_list_id) ?></td>
                    <td><?= h($registerCandidateEventActivities->full_name) ?></td>
                    <td><?= h($registerCandidateEventActivities->dob) ?></td>
                    <td><?= h($registerCandidateEventActivities->gender_list_id) ?></td>
                    <td><?= h($registerCandidateEventActivities->registration_number) ?></td>
                    <td><?= h($registerCandidateEventActivities->event_team_detail_id) ?></td>
                    <td><?= h($registerCandidateEventActivities->weight) ?></td>
                    <td><?= h($registerCandidateEventActivities->age) ?></td>
                    <td><?= h($registerCandidateEventActivities->event_qualifying_status) ?></td>
                    <td><?= h($registerCandidateEventActivities->attendance_status) ?></td>
                    <td><?= h($registerCandidateEventActivities->certificate_download_status) ?></td>
                    <td><?= h($registerCandidateEventActivities->active) ?></td>
                    <td><?= h($registerCandidateEventActivities->action_by) ?></td>
                    <td><?= h($registerCandidateEventActivities->created) ?></td>
                    <td><?= h($registerCandidateEventActivities->action_ip) ?></td>
                    <td><?= h($registerCandidateEventActivities->modified) ?></td>
                    <td><?= h($registerCandidateEventActivities->state_list_id) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'RegisterCandidateEventActivities', 'action' => 'view', $registerCandidateEventActivities->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'RegisterCandidateEventActivities', 'action' => 'edit', $registerCandidateEventActivities->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'RegisterCandidateEventActivities', 'action' => 'delete', $registerCandidateEventActivities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $registerCandidateEventActivities->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related RegisterCandidateEventActivities</p>
    <?php endif; ?>
</div>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related RegisterCandidates') ?></h3>
    </div>
    <?php if (!empty($eventActivityList->register_candidates)): ?>
        <table class="table table-striped">
               <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('event_activity_list_id'); ?></th>
            <th><?= $this->Paginator->sort('full_name'); ?></th>
            <th><?= $this->Paginator->sort('dob'); ?></th>
            <th><?= $this->Paginator->sort('gender_list_id'); ?></th>
            <th><?= $this->Paginator->sort('registration_number'); ?></th>
            <th><?= $this->Paginator->sort('event_team_detail_id'); ?></th>
            <th><?= $this->Paginator->sort('weight'); ?></th>
            <th><?= $this->Paginator->sort('age'); ?></th>
            <th><?= $this->Paginator->sort('event_qualifying_status'); ?></th>
            <th><?= $this->Paginator->sort('attendance_status'); ?></th>
            <th><?= $this->Paginator->sort('certificate_download_status'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th><?= $this->Paginator->sort('state_list_id'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
           
            <tbody>
            <?php foreach ($eventActivityList->register_candidates as $registerCandidates): ?>
                <tr>
                    <td><?= h($registerCandidates->id) ?></td>
                    <td><?= h($registerCandidates->event_activity_list_id) ?></td>
                    <td><?= h($registerCandidates->full_name) ?></td>
                    <td><?= h($registerCandidates->dob) ?></td>
                    <td><?= h($registerCandidates->gender_list_id) ?></td>
                    <td><?= h($registerCandidates->registration_number) ?></td>
                    <td><?= h($registerCandidates->event_team_detail_id) ?></td>
                    <td><?= h($registerCandidates->weight) ?></td>
                    <td><?= h($registerCandidates->age) ?></td>
                    <td><?= h($registerCandidates->event_qualifying_status) ?></td>
                    <td><?= h($registerCandidates->attendance_status) ?></td>
                    <td><?= h($registerCandidates->certificate_download_status) ?></td>
                    <td><?= h($registerCandidates->active) ?></td>
                    <td><?= h($registerCandidates->action_by) ?></td>
                    <td><?= h($registerCandidates->created) ?></td>
                    <td><?= h($registerCandidates->action_ip) ?></td>
                    <td><?= h($registerCandidates->modified) ?></td>
                    <td><?= h($registerCandidates->state_list_id) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'RegisterCandidates', 'action' => 'view', $registerCandidates->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'RegisterCandidates', 'action' => 'edit', $registerCandidates->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'RegisterCandidates', 'action' => 'delete', $registerCandidates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $registerCandidates->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related RegisterCandidates</p>
    <?php endif; ?>
</div>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related TeamTieSheets') ?></h3>
    </div>
    <?php if (!empty($eventActivityList->team_tie_sheets)): ?>
        <table class="table table-striped">
               <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('event_team_detail_id'); ?></th>
            <th><?= $this->Paginator->sort('opponent_event_team_detail_id'); ?></th>
            <th><?= $this->Paginator->sort('match_number'); ?></th>
            <th><?= $this->Paginator->sort('winner_team_detail_id'); ?></th>
            <th><?= $this->Paginator->sort('event_activity_list_id'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
           
            <tbody>
            <?php foreach ($eventActivityList->team_tie_sheets as $teamTieSheets): ?>
                <tr>
                    <td><?= h($teamTieSheets->id) ?></td>
                    <td><?= h($teamTieSheets->event_team_detail_id) ?></td>
                    <td><?= h($teamTieSheets->opponent_event_team_detail_id) ?></td>
                    <td><?= h($teamTieSheets->match_number) ?></td>
                    <td><?= h($teamTieSheets->winner_team_detail_id) ?></td>
                    <td><?= h($teamTieSheets->event_activity_list_id) ?></td>
                    <td><?= h($teamTieSheets->active) ?></td>
                    <td><?= h($teamTieSheets->action_by) ?></td>
                    <td><?= h($teamTieSheets->created) ?></td>
                    <td><?= h($teamTieSheets->action_ip) ?></td>
                    <td><?= h($teamTieSheets->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'TeamTieSheets', 'action' => 'view', $teamTieSheets->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'TeamTieSheets', 'action' => 'edit', $teamTieSheets->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'TeamTieSheets', 'action' => 'delete', $teamTieSheets->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teamTieSheets->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related TeamTieSheets</p>
    <?php endif; ?>
</div>
