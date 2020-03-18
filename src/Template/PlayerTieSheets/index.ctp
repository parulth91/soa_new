<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('event_activity_list_id'); ?></th>
            <th><?= $this->Paginator->sort('round_number'); ?></th>
            <th><?= $this->Paginator->sort('round_description'); ?></th>
            <th><?= $this->Paginator->sort('player1_score'); ?></th>
            <th><?= $this->Paginator->sort('player2_score'); ?></th>
            <th><?= $this->Paginator->sort('winner_register_candidate_event_activity_id'); ?></th>
            <th><?= $this->Paginator->sort('match_number'); ?></th>
            <th><?= $this->Paginator->sort('player1_register_candidate_event_activity_id'); ?></th>
            <th><?= $this->Paginator->sort('player2_register_candidate_event_activity_id'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($playerTieSheets as $playerTieSheet): ?>
        <tr>
            <td><?= $this->Number->format($playerTieSheet->id) ?></td>
            <td>
                <?= $playerTieSheet->has('event_activity_list') ? $this->Html->link($playerTieSheet->event_activity_list->description, ['controller' => 'EventActivityLists', 'action' => 'view', $playerTieSheet->event_activity_list->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($playerTieSheet->round_number) ?></td>
            <td><?= h($playerTieSheet->round_description) ?></td>
            <td><?= $this->Number->format($playerTieSheet->player1_score) ?></td>
            <td><?= $this->Number->format($playerTieSheet->player2_score) ?></td>
            <td><?= $this->Number->format($playerTieSheet->winner_register_candidate_event_activity_id) ?></td>
            <td><?= $this->Number->format($playerTieSheet->match_number) ?></td>
            <td><?= $this->Number->format($playerTieSheet->player1_register_candidate_event_activity_id) ?></td>
            <td><?= $this->Number->format($playerTieSheet->player2_register_candidate_event_activity_id) ?></td>
                        <td><?= $playerTieSheet->active ? __('Yes') : __('No'); ?></td>
                                    <td><?= $this->Number->format($playerTieSheet->action_by) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $playerTieSheet->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $playerTieSheet->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $playerTieSheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $playerTieSheet->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
    echo $this->Form->submit('Add playerTieSheets', array('type' => 'button',
        'class' => 'btn  btn-info',
        'onclick' => "location.href='" . $this->Url->build('/playerTieSheets/add') . "'"));
    ?>
</div>