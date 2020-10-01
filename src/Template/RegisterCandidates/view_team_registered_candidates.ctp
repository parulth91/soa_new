<?php

/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php echo $this->Form->create('team_list_form'); ?>
<?php
if (!empty($teamDetails)) 
{
?>
<div class="row">
    <?php
    if (isset($registeredCandidatePaginate)) {
      $registeredCandidatePaginate = $registeredCandidatePaginate;
    } else {
      $registeredCandidatePaginate = 0;
    }
    ?>
    <fieldset>
        <p style="color: red">
            Note: View Your Team Details after submission.

        </p>
        <div class=col-md-5>
        <?php
        //  if ($eventActivityListValue->activity_list->game_type_list->description != 'Individual') {

        echo $this->Form->input('event_team_id', [
          'type' => 'select',
          'label' => 'Select Team',
          'empty' => "Select ",
          'options' => $teamDetails,
          'required' => 'true'
        ]);
        ?>
        </div>
    </fieldset>
    <?= $this->Form->button("View Registered Team", ['name' => 'view_registered_button', 'id' => 'view_registered_button', 'class' => 'btn btn-primary']); ?>
  <?php } ?>
</div>
<div id="event_descripion_div" class="pen-title">
    <?php //debug($registeredCandidateLists->event_activity_list->event_list->description);die;
    ?>
    <div class="pen-title">
        <h3>
        <?php  if(isset($registerCandidateEventActivities)) {
          $EventDescription   = $registerCandidateEventActivities->toArray();
         // debug($EventDescription);//die;
        ?>
            Registered Candidate for <?php if (isset($EventDescription[0]->event_activity_list->description)) {
                                  echo $EventDescription[0]->event_activity_list->description;
                                } else {
                                    
                                }
                                ?>
        </h3>
        <!-- <h4>
          //   Minimum players present for team completion is :
            <?php 
         //   echo $teamMinAttendanceCheck;
            ?>
         </h4>-->
    </div>
</div>

<fieldset>

    <table class="table table-striped" cellpadding="0" cellspacing="0" id="attendance_list">
        <thead>
            <tr>
                <th>S.NO </th>
                <th><?= $this->Paginator->sort('id'); ?></th>
                <th><?= $this->Paginator->sort('event_activity_list_id'); ?></th>
                <th><?= $this->Paginator->sort('full_name'); ?></th>
                <th><?= $this->Paginator->sort('dob'); ?></th>
                <th><?= $this->Paginator->sort('gender_list_id'); ?></th>
                <th><?= $this->Paginator->sort('registration_number'); ?></th>
                <th><?= $this->Paginator->sort('State_id'); ?></th>
                <th><?= $this->Paginator->sort('event_team_detail_id'); ?></th>
                <th><?= $this->Paginator->sort('weight'); ?></th>
                <th><?= $this->Paginator->sort('age'); ?></th>
                <th><?= $this->Paginator->sort('event_qualifying_status'); ?></th>
                <th><?= $this->Paginator->sort('attendance_status'); ?></th>
                <th><?= $this->Paginator->sort('certificate_download_status'); ?></th>
                <th class="actions"><?= __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
        <?php //debug($registerCandidateEventActivities);//die; 
           $i=1;
        foreach ($registerCandidateEventActivities as $registerCandidateEventActivity): ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?= $this->Number->format($registerCandidateEventActivity->id) ?></td>
                <td>
                <?= $registerCandidateEventActivity->has('event_activity_list') ? $this->Html->link($registerCandidateEventActivity->event_activity_list->description, ['controller' => 'EventActivityLists', 'action' => 'view', $registerCandidateEventActivity->event_activity_list->id]) : '' ?>
                </td>
                <td><?= h($registerCandidateEventActivity->full_name) ?></td>
                <td><?php echo date_format($registerCandidateEventActivity->dob,"d/m/Y");?></td>
                <td>
                <?= h($registerCandidateEventActivity['gender_list']['description']) 
                //= $registerCandidateEventActivity->has('gender_list') ? $this->Html->link($registerCandidateEventActivity->gender_list->description, ['controller' => 'GenderLists', 'action' => 'view', $registerCandidateEventActivity->gender_list->id]) : '' ?>
                </td>
                <td><?= h($registerCandidateEventActivity->registration_number) ?></td>
                <td><?= h($registerCandidateEventActivity['state_list']['description']) ?></td>
                <td>
                <?php
                 if($registerCandidateEventActivity['event_team_detail']['description']!='')
                   {  
                     echo $registerCandidateEventActivity['event_team_detail']['description'];}
                   else{
                       echo 'Not Applicable';
                   }
                   //= $registerCandidateEventActivity->has('event_team_detail') ? $this->Html->link($registerCandidateEventActivity->event_team_detail->description, ['controller' => 'EventTeamDetails', 'action' => 'view', $registerCandidateEventActivity->event_team_detail->id]) : '' 
                ?>
                </td>
                <td><?= $this->Number->format($registerCandidateEventActivity->weight) ?></td>
                <td><?= $this->Number->format($registerCandidateEventActivity->age) ?></td>
                <td><?= $registerCandidateEventActivity->event_qualifying_status ? __('Yes') : __('No'); ?></td>
                <td><?= $registerCandidateEventActivity->attendance_status ? __('Yes') : __('No'); ?></td>
                <td><?= $registerCandidateEventActivity->certificate_download_status ? __('Yes') : __('No'); ?></td>
                <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $registerCandidateEventActivity->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $registerCandidateEventActivity->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                </td>
            </tr>
      <?php  
      $i++;
      endforeach; ?>
        </tbody>

    </table>
  <?php } else {
          echo '<span color="red">';
          "No record Found";
          '</span>';
        } ?>
  <?= $this->Form->end() ?>


</fieldset>
<script>

    $(document).ready(function () {

        $("#update_attendance_button").click(function (e) {
            //  alert('butoonupadte');
            // document.getElementById('event-team-id').value='';
        });
    });
</script>