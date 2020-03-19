<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($playerTieSheet->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Event Activity List') ?></td>
            <td><?= $playerTieSheet->has('event_activity_list') ? $this->Html->link($playerTieSheet->event_activity_list->description, ['controller' => 'EventActivityLists', 'action' => 'view', $playerTieSheet->event_activity_list->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Round Description') ?></td>
            <td><?= h($playerTieSheet->round_description) ?></td>
        </tr>
        <tr>
            <td><?= __('Winner Player') ?></td>
            <td><?= $playerTieSheet->has('winner_player') ? $this->Html->link($playerTieSheet->winner_player->description, ['controller' => 'RegisterCandidateEventActivities', 'action' => 'view', $playerTieSheet->winner_player->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Player1') ?></td>
            <td><?= $playerTieSheet->has('player1') ? $this->Html->link($playerTieSheet->player1->description, ['controller' => 'RegisterCandidateEventActivities', 'action' => 'view', $playerTieSheet->player1->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Player2') ?></td>
            <td><?= $playerTieSheet->has('player2') ? $this->Html->link($playerTieSheet->player2->description, ['controller' => 'RegisterCandidateEventActivities', 'action' => 'view', $playerTieSheet->player2->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Action Ip') ?></td>
            <td><?= h($playerTieSheet->action_ip) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($playerTieSheet->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Round Number') ?></td>
            <td><?= $this->Number->format($playerTieSheet->round_number) ?></td>
        </tr>
        <tr>
            <td><?= __('Player1 Score') ?></td>
            <td><?= $this->Number->format($playerTieSheet->player1_score) ?></td>
        </tr>
        <tr>
            <td><?= __('Player2 Score') ?></td>
            <td><?= $this->Number->format($playerTieSheet->player2_score) ?></td>
        </tr>
        <tr>
            <td><?= __('Match Number') ?></td>
            <td><?= $this->Number->format($playerTieSheet->match_number) ?></td>
        </tr>
        <tr>
            <td><?= __('Action By') ?></td>
            <td><?= $this->Number->format($playerTieSheet->action_by) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($playerTieSheet->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($playerTieSheet->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Active') ?></td>
            <td><?= $playerTieSheet->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

