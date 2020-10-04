<?php

/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('S.N.O'); ?></th>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('Event'); ?></th>
            <th><?= $this->Paginator->sort('Activity'); ?></th>
            <th><?= $this->Paginator->sort('Game type'); ?></th>
            <th><?= $this->Paginator->sort('Event Start Date'); ?></th>
            <th><?= $this->Paginator->sort('Event End Date'); ?></th>
            <th><?= $this->Paginator->sort('Registration Start Date'); ?></th>
            <th><?= $this->Paginator->sort('Registration End Date'); ?></th>

            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($nameResult as $List):
            //debug($List);
            ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $this->Number->format($List->id) ?></td>
            <td><?= h($List['event_list']['description']) ?></td>
            <td><?= h($List['activity_list']['description']) ?></td>
            <td><?= h($List['activity_list']['game_type_list']['description']) ?></td>
            <td><?php echo date_format($List['event_list']['event_start_date'],"d/m/Y"); ?></td>
            <td><?php echo date_format($List['event_list']['event_end_date'],"d/m/Y"); ?></td>
            <td><?php echo date_format($List['event_list']['registration_start_date'],"d/m/Y"); ?></td>
            <td><?php echo date_format($List['event_list']['registration_end_date'],"d/m/Y");?></td>





            <td class="actions">

                    <?= $this->Html->link('Register', ['controller' => 'RegisterCandidates', 'action' => 'eventActivitiesStudentRegister', $List->id], ['Register Now', 'type' => 'button', 'class' => 'btn  btn-info']) ?>

                    <?php
                    if ($List->activity_list->game_type_list->description == 'Team') {
                        //  debug($List->activity_list->game_type_list->description);
                        echo $this->Html->link('View', ['controller' => 'RegisterCandidates', 'action' => 'viewTeamRegisteredCandidates', $List->id], ['Mark Atendance', 'type' => 'button', 'class' => 'btn  btn-primary']);
                        echo $this->Html->link('Attendance', ['action' => 'eventActivtiesTeamAttendance', $List->id], ['Mark Atendance', 'type' => 'button', 'class' => 'btn  btn-warning']);
                          echo  $this->Form->postLink('Delete Tie', [
                            'controller' => 'RegisterCandidates',
                            'action' => 'finalize', 
                            $List->id], 
                                ['confirm' => __('Are you sure you want to Finalize attendance? After this taking attendence will not be  possible# {0}?',$List['activity_list']['description']),
                                    'title' => __('Delete'),
                                    'class' => 'btn btn-info'
                                    ]);
                             //if($List->finalize_attendance == false){
                                     echo $this->Html->link('Tie Sheet', ['controller' => 'MyTeams', 'action' => 'tieSheet', $List->id], ['Mark Atendance', 'type' => 'button', 'class' => 'btn  btn-danger']);
                                     echo $this->Html->link('Result', ['controller' => 'MyTeams', 'action' => 'index', $List->id], ['Mark Atendance', 'type' => 'button', 'class' => 'btn  btn-success']);
                    
                           // }
                       
                     } elseif ($List->activity_list->game_type_list->description == 'Individual') {
                        echo $this->Html->link('View', ['controller' => 'RegisterCandidates', 'action' => 'viewIndividualRegisteredCandidates', $List->id], ['Mark Atendance', 'type' => 'button', 'class' => 'btn  btn-primary']);
                        echo $this->Html->link('Attendance', ['action' => 'eventActivtiesIndividualAttendance', $List->id], ['Mark Atendance', 'type' => 'button', 'class' => 'btn  btn-warning']);
                       
                        
                        echo  $this->Form->postLink('Delete Tie', [
                            'controller' => 'RegisterCandidates',
                            'action' => 'finalize', 
                            $List->id], 
                                ['confirm' => __('Are you sure you want to Finalize attendance? After this taking attendence will not be  possible# {0}?',$List['activity_list']['description']),
                                    'title' => __('Delete'),
                                    'class' => 'btn btn-info'
                                    ]);
                       // if($List->finalize_attendance== false){
                                 echo $this->Html->link('Tie Sheet', ['controller' => 'MyPlayers', 'action' => 'tieSheet', $List->id], ['Mark Atendance', 'type' => 'button', 'class' => 'btn  btn-danger']);
                                 echo $this->Html->link('Result', ['controller' => 'MyPlayers', 'action' => 'index', $List->id], ['Mark Atendance', 'type' => 'button', 'class' => 'btn  btn-success']);
                       
                           // }
                        }
                    ?>

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
// echo $this->Form->submit('Add weightCategoryLists', array('type' => 'button',
//     'class' => 'btn  btn-info',
//    'onclick' => "location.href='" . $this->Url->build('/weightCategoryLists/add') . "'"));
    ?>
</div>