<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
 echo $this->Html->link('Tie Sheet', ['controller' => 'MyTeams', 'action' => 'tieSheet', $id], ['Mark Atendance', 'type' => 'button', 'class' => 'btn  btn-danger']);
                                    
?>
<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= "Sno" ?></th>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('event_activity_list_id', '  Event Activty'); ?></th>
            <th><?= $this->Paginator->sort('round_number'); ?></th>
            <th><?= $this->Paginator->sort('round_description'); ?></th>
            <th><?= $this->Paginator->sort('team1_score'); ?></th>
            <th><?= $this->Paginator->sort('team2_score'); ?></th>
            <th><?= $this->Paginator->sort('winner_event_team_detail_id','Winner Team'); ?></th>
            <th><?= $this->Paginator->sort('match_number'); ?></th>
            <th><?= $this->Paginator->sort('team1_event_team_detail_id','Team 1'); ?></th>
            <th><?= $this->Paginator->sort('team2_event_team_detail_id','Team 2'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i=1;
        foreach ($teamTieSheets as $teamTieSheet): ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $this->Number->format($teamTieSheet->id) ?></td>
                <td>
                    <?= $teamTieSheet->has('event_activity_list') ? $this->Html->link($teamTieSheet->event_activity_list->description, ['controller' => 'EventActivityLists', 'action' => 'view', $teamTieSheet->event_activity_list->id]) : '' ?>
                </td>
                <td><?= $this->Number->format($teamTieSheet->round_number) ?></td>
                <td><?= h($teamTieSheet->round_description) ?></td>
                <td><?= $this->Number->format($teamTieSheet->team1_score) ?></td>
                <td><?= $this->Number->format($teamTieSheet->team2_score) ?></td>
                <td>
                    <?= $teamTieSheet->has('winner_event_team_detail') ? $this->Html->link($teamTieSheet->winner_event_team_detail->description, ['controller' => 'EventTeamDetails', 'action' => 'view', $teamTieSheet->winner_event_team_detail->id]) : '' ?>
                </td>
                <td><?= $this->Number->format($teamTieSheet->match_number) ?></td>
                <td>
                    <?= $teamTieSheet->has('team1_event_team_detail') ? $this->Html->link($teamTieSheet->team1_event_team_detail->description, ['controller' => 'EventTeamDetails', 'action' => 'view', $teamTieSheet->team1_event_team_detail->id]) : '' ?>
                </td>
                <td>
                    <?= $teamTieSheet->has('team2_event_team_detail') ? $this->Html->link($teamTieSheet->team2_event_team_detail->description, ['controller' => 'EventTeamDetails', 'action' => 'view', $teamTieSheet->team2_event_team_detail->id]) : '' ?>
                </td>
                <td><?= $teamTieSheet->active ? __('Yes') : __('No'); ?></td>
                <td><?= $this->Number->format($teamTieSheet->action_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link('', ['action' => 'view', $teamTieSheet->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>

                    <?php
                    if (!empty($teamTieSheet->team1_event_team_detail_id) && !empty($teamTieSheet->team2_event_team_detail_id)) {
                        echo $this->Html->link('', ['action' => 'update_result', 
                            $teamTieSheet->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']);
                    }
                    ?>
                    <?php // $this->Form->postLink('', ['action' => 'delete', $teamTieSheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teamTieSheet->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                </td>
            </tr>
        <?php 
        $i++;
        endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>

        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>

<div>
    <?php
//    echo $this->Form->submit('Add teamTieSheets', array('type' => 'button',
//        'class' => 'btn  btn-info',
//        'onclick' => "location.href='" . $this->Url->build('/teamTieSheets/add') . "'"));
    ?>
</div>