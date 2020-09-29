<?php

/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
$registeredCandidateData   = $registeredCandidatePaginate->toArray();
//debug($registeredCandidateData);'url' => array('controller' => 'posts', 'action' => 'add', $post_id
echo $this->Form->create(
    'attendance_form'
    //['url' => [
    // 'controller' => 'RegisterCandidates', 'action' => 'eventActivitiesIndividualAttendance',
    //  $registeredCandidateData[0]->event_activity_list_id
    //]]
); ?>

<div id="event_descripion_div" class="pen-title">
    <?php //debug($registeredCandidateLists->event_activity_list->event_list->description);die;
    ?>
    <div class="pen-title">
        <h3>
            <?php
            $EventDescription   = $registeredCandidatePaginate->toArray();
            //debug($EventDescription[0]->event_activity_list->event_list);die;
            ?>
            Attendance Sheet for <?php if (isset($registeredCandidateData[0]->event_activity_list->description)) {
                                        echo $registeredCandidateData[0]->event_activity_list->description;
                                    } else {
                                    }
                                    ?>
        </h3>
    </div>
</div>

<fieldset>

    <table class="table table-striped" cellpadding="0" cellspacing="0" id="attendance_list">
        <thead>
            <tr>

                <th><?= $this->Paginator->sort('S.NO'); ?></th>
                <th><?= $this->Paginator->sort('Id'); ?></th>
                <th><?= $this->Paginator->sort('Registration Number'); ?></th>
                <th><?= $this->Paginator->sort('State'); ?></th>
                <th><?= $this->Paginator->sort('GameType'); ?></th>
                <th><?= $this->Paginator->sort('Activity'); ?></th>
                <th><?= $this->Paginator->sort('Name'); ?></th>
                <th><?= $this->Paginator->sort('Age'); ?></th>
                <th><?= $this->Paginator->sort('Weight'); ?></th>
                <th><?= $this->Paginator->sort('Attendance Status'); ?></th>
                <th class="actions"><?= __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <?php 
                
                $i=1;
                foreach ($registeredCandidatePaginate as $registeredCandidateView) :
               // debug($registeredCandidateView);die; ?>
                <td><?= $i ?></td>
                <td><?= $this->Number->format($registeredCandidateView->id) ?></td>
                <td><?= h($registeredCandidateView->registration_number) ?></td>
                <td><?= h($registeredCandidateView['state_list']['description']) ?></td>
                <td>
                        <?= $registeredCandidateView->event_activity_list->activity_list->game_type_list->description; ?>
                </td>
                <td> <?= $registeredCandidateView->event_activity_list->activity_list->description; ?></td>
                <td><?= $registeredCandidateView->full_name; ?></td>
                <td><?= $registeredCandidateView->age;  ?></td>
                <td><?= $registeredCandidateView->weight;  ?></td>
                <td><?php if ($registeredCandidateView->attendance_status == 'true') {
                            echo "Present";
                        } else {
                            echo "Absent";
                        }
                        ?></td>
                    <?php //echo '<td class="actions">' . $this->Form->checkbox(
                      //  'attendance_status.' . $registeredCandidateView->id . '.checkid',
                      //  array('value' => $registeredCandidateView->id)
                  //  ) . '</td>';
                    ?>
                <td class="actions"><?php //debug($registeredCandidateView->id;)
                        if($registeredCandidateView->attendance_status == 'true')
                        {
                        echo $this->Form->checkbox(
                                              'attendance_status' . "[$registeredCandidateView->id]" ,
                                              ['value' => "$registeredCandidateView->id ",  'checked' => true]                                      
                                            );}
                                            else{
                                              echo $this->Form->checkbox(
                                                'attendance_status' . "[$registeredCandidateView->id]" ,
                                                ['value' => "$registeredCandidateView->id ",'checked' => false]                                      
                                              );  
                        } ?>
                </td>

            </tr>
        <?php
        $i++;
        endforeach;  ?>
        </tbody>

    </table>


</fieldset>
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

<?php
if($playerTieSheetEntryCount > 0){
    $this->Form->button("Save", ['name' => 'update_attendance_button', 'id' => 'update_attendance_button', 'class' => 'btn btn-primary']);
}


?>
<?= $this->Form->end() ?>