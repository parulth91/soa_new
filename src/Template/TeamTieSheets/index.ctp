<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
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
        <?php foreach ($teamTieSheets as $teamTieSheet): ?>
        <tr>
            <td><?= $this->Number->format($teamTieSheet->id) ?></td>
            <td><?= $this->Number->format($teamTieSheet->event_team_detail_id) ?></td>
            <td><?= $this->Number->format($teamTieSheet->opponent_event_team_detail_id) ?></td>
            <td><?= $this->Number->format($teamTieSheet->match_number) ?></td>
            <td>
                <?= $teamTieSheet->has('event_team_detail') ? $this->Html->link($teamTieSheet->event_team_detail->description, ['controller' => 'EventTeamDetails', 'action' => 'view', $teamTieSheet->event_team_detail->id]) : '' ?>
            </td>
            <td>
                <?= $teamTieSheet->has('event_activity_list') ? $this->Html->link($teamTieSheet->event_activity_list->description, ['controller' => 'EventActivityLists', 'action' => 'view', $teamTieSheet->event_activity_list->id]) : '' ?>
            </td>
                        <td><?= $teamTieSheet->active ? __('Yes') : __('No'); ?></td>
                                    <td><?= $this->Number->format($teamTieSheet->action_by) ?></td>
            <td><?= h($teamTieSheet->created) ?></td>
            <td><?= h($teamTieSheet->action_ip) ?></td>
            <td><?= h($teamTieSheet->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $teamTieSheet->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $teamTieSheet->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $teamTieSheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teamTieSheet->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
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
    echo $this->Form->submit('Add teamTieSheets', array('type' => 'button',
        'class' => 'btn  btn-info',
        'onclick' => "location.href='" . $this->Url->build('/teamTieSheets/add') . "'"));
    ?>
</div>