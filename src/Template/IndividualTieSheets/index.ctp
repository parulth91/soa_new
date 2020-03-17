<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('register_candidate_event_activity_id'); ?></th>
            <th><?= $this->Paginator->sort('opponent_register_candidate_event_activity_id'); ?></th>
            <th><?= $this->Paginator->sort('match_number'); ?></th>
            <th><?= $this->Paginator->sort('winner_register_candidate_event_activity_id'); ?></th>
            <th><?= $this->Paginator->sort('event_activity_list_id'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th><?= $this->Paginator->sort('result_status_list_id'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($individualTieSheets as $individualTieSheet): ?>
        <tr>
            <td><?= $this->Number->format($individualTieSheet->id) ?></td>
            <td><?= $this->Number->format($individualTieSheet->register_candidate_event_activity_id) ?></td>
            <td><?= $this->Number->format($individualTieSheet->opponent_register_candidate_event_activity_id) ?></td>
            <td><?= $this->Number->format($individualTieSheet->match_number) ?></td>
            <td>
                <?= $individualTieSheet->has('register_candidate_event_activity') ? $this->Html->link($individualTieSheet->register_candidate_event_activity->description, ['controller' => 'RegisterCandidateEventActivities', 'action' => 'view', $individualTieSheet->register_candidate_event_activity->id]) : '' ?>
            </td>
            <td>
                <?= $individualTieSheet->has('event_activity_list') ? $this->Html->link($individualTieSheet->event_activity_list->description, ['controller' => 'EventActivityLists', 'action' => 'view', $individualTieSheet->event_activity_list->id]) : '' ?>
            </td>
                        <td><?= $individualTieSheet->active ? __('Yes') : __('No'); ?></td>
                                    <td><?= $this->Number->format($individualTieSheet->action_by) ?></td>
            <td><?= h($individualTieSheet->created) ?></td>
            <td><?= h($individualTieSheet->action_ip) ?></td>
            <td><?= h($individualTieSheet->modified) ?></td>
            <td><?= $this->Number->format($individualTieSheet->result_status_list_id) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $individualTieSheet->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $individualTieSheet->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $individualTieSheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $individualTieSheet->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
    echo $this->Form->submit('Add individualTieSheets', array('type' => 'button',
        'class' => 'btn  btn-info',
        'onclick' => "location.href='" . $this->Url->build('/individualTieSheets/add') . "'"));
    ?>
</div>