<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($teamTieSheet->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Event Team Detail') ?></td>
            <td><?= $teamTieSheet->has('event_team_detail') ? $this->Html->link($teamTieSheet->event_team_detail->description, ['controller' => 'EventTeamDetails', 'action' => 'view', $teamTieSheet->event_team_detail->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Event Activity List') ?></td>
            <td><?= $teamTieSheet->has('event_activity_list') ? $this->Html->link($teamTieSheet->event_activity_list->description, ['controller' => 'EventActivityLists', 'action' => 'view', $teamTieSheet->event_activity_list->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Action Ip') ?></td>
            <td><?= h($teamTieSheet->action_ip) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($teamTieSheet->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Event Team Detail Id') ?></td>
            <td><?= $this->Number->format($teamTieSheet->event_team_detail_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Opponent Event Team Detail Id') ?></td>
            <td><?= $this->Number->format($teamTieSheet->opponent_event_team_detail_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Match Number') ?></td>
            <td><?= $this->Number->format($teamTieSheet->match_number) ?></td>
        </tr>
        <tr>
            <td><?= __('Action By') ?></td>
            <td><?= $this->Number->format($teamTieSheet->action_by) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($teamTieSheet->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($teamTieSheet->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Active') ?></td>
            <td><?= $teamTieSheet->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

