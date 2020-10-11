<?php

/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<div>
    <?php
    echo $this->Html->link('Tie Sheet', ['controller' => 'MyPlayers', 'action' => 'tieSheet', $id], ['Tie Sheet', 'type' => 'button', 'class' => 'btn  btn-danger']);
         ?>                       
</div>
<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>SNO.</th>
            <th><?= $this->Paginator->sort('event_activity_list_id'); ?></th>
            <th><?= $this->Paginator->sort('round_description'); ?></th>
            <th><?= $this->Paginator->sort('round_number'); ?></th>



            <th><?= $this->Paginator->sort('match_number'); ?></th>
            <th><?= $this->Paginator->sort('player1_id'); ?></th>
            <th><?= $this->Paginator->sort('player2_id'); ?></th>
            <th><?= $this->Paginator->sort('player1_score'); ?></th>
            <th><?= $this->Paginator->sort('player2_score'); ?></th>
            <th><?= $this->Paginator->sort('winner_player_id'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($playerTieSheets as $playerTieSheet): ?>
        <tr>
            <td><?= $i ?></td>
            <td>
                    <?= $playerTieSheet->has('event_activity_list') ? $this->Html->link($playerTieSheet->event_activity_list->description, ['controller' => 'EventActivityLists', 'action' => 'view', $playerTieSheet->event_activity_list->id]) : '' ?>
            </td>
            <td><?= h($playerTieSheet->round_description) ?></td>
            <td><?= $this->Number->format($playerTieSheet->round_number) ?></td>



            <td><?= $this->Number->format($playerTieSheet->match_number) ?></td>
            <td>
                    <?php
                     if($playerTieSheet->bye_player_id != null && $playerTieSheet->player1_id == null){
                         if($playerTieSheet->player1_id == null){
                             echo "BYE";
                         }
                     }else{
                         if($playerTieSheet->player1 !=null){
                              echo $playerTieSheet->player1->registration_number.' ('.$playerTieSheet->player1->id.')';
                         }
                        
                     }
                    ?>
            </td>
            <td>
                 <?php
                     if($playerTieSheet->bye_player_id != null && $playerTieSheet->player2_id == null){
                         if($playerTieSheet->player2_id == null){
                             echo "BYE";
                         }
                     }else{
                         if($playerTieSheet->player2 != null){
                             echo $playerTieSheet->player2->registration_number.' ('.$playerTieSheet->player2->id.')';
                         }
                         
                     }
                    ?>
                    </td>
            <td><?= $this->Number->format($playerTieSheet->player1_score) ?></td>
            <td><?= $this->Number->format($playerTieSheet->player2_score) ?></td>
            <td>
                    <?= $playerTieSheet->has('winner_player') ? $this->Html->link($playerTieSheet->winner_player->registration_number.' ('.$playerTieSheet->winner_player->full_name.')', ['controller' => 'RegisterCandidateEventActivities', 'action' => 'view', $playerTieSheet->winner_player->id]) : '' ?>
            </td>
            <td><?= $playerTieSheet->active ? __('Yes') : __('No'); ?></td>
            <td><?= $this->Number->format($playerTieSheet->action_by) ?></td>
            <td class="actions">
                    <?= $this->Html->link('', ['action' => 'view', $playerTieSheet->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                    <?php
                    if (!empty($playerTieSheet->player1_id) && !empty($playerTieSheet->player2_id)) {
                        echo $this->Html->link('', ['action' => 'update_result',
                            $playerTieSheet->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']);
                    }
                    ?>
                    <?php // $this->Form->postLink('', ['action' => 'delete', $playerTieSheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $playerTieSheet->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
            </td>
        </tr>
        <?php
        $i++;
        endforeach; ?>
    </tbody>
</table>
<!--<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>

        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>-->

<div>
    <?php
//    echo $this->Form->submit('Add playerTieSheets', array('type' => 'button',
//        'class' => 'btn  btn-info',
//        'onclick' => "location.href='" . $this->Url->build('/playerTieSheets/add') . "'"));
    ?>
</div>