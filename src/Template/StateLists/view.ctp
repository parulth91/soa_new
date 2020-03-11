<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($stateList->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Description') ?></td>
            <td><?= h($stateList->description) ?></td>
        </tr>
        <tr>
            <td><?= __('Country List') ?></td>
            <td><?= $stateList->has('country_list') ? $this->Html->link($stateList->country_list->description, ['controller' => 'CountryLists', 'action' => 'view', $stateList->country_list->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Action Ip') ?></td>
            <td><?= h($stateList->action_ip) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($stateList->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Action By') ?></td>
            <td><?= $this->Number->format($stateList->action_by) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($stateList->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($stateList->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Active') ?></td>
            <td><?= $stateList->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related DistrictLists') ?></h3>
    </div>
    <?php if (!empty($stateList->district_lists)): ?>
        <table class="table table-striped">
               <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('state_list_id'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
           
            <tbody>
            <?php foreach ($stateList->district_lists as $districtLists): ?>
                <tr>
                    <td><?= h($districtLists->id) ?></td>
                    <td><?= h($districtLists->description) ?></td>
                    <td><?= h($districtLists->state_list_id) ?></td>
                    <td><?= h($districtLists->active) ?></td>
                    <td><?= h($districtLists->action_by) ?></td>
                    <td><?= h($districtLists->created) ?></td>
                    <td><?= h($districtLists->action_ip) ?></td>
                    <td><?= h($districtLists->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'DistrictLists', 'action' => 'view', $districtLists->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'DistrictLists', 'action' => 'edit', $districtLists->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'DistrictLists', 'action' => 'delete', $districtLists->id], ['confirm' => __('Are you sure you want to delete # {0}?', $districtLists->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related DistrictLists</p>
    <?php endif; ?>
</div>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related EventTeamDetails') ?></h3>
    </div>
    <?php if (!empty($stateList->event_team_details)): ?>
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
            <?php foreach ($stateList->event_team_details as $eventTeamDetails): ?>
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
    <?php if (!empty($stateList->register_candidate_event_activities)): ?>
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
            <?php foreach ($stateList->register_candidate_event_activities as $registerCandidateEventActivities): ?>
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
