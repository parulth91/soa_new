<?php

/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<div style="float:right;">
<div class="topmargin30">
<input type="button" onclick="printDiv('printableArea')" value="Print"class="btn btn-primary" />
</div>
</div>
<?php echo $this->Form->create('team_list_form'); ?>
 <?php
    if (isset($registeredCandidatePaginate)) {
      $registeredCandidatePaginate = $registeredCandidatePaginate;
    } else {
      $registeredCandidatePaginate = 0;
    }
    ?>
<?php
if (!empty($teamDetails)) {
?>
<div class="row">

    <fieldset>
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
    <?= $this->Form->button("View Attendance List", ['name' => 'view_attendance_button', 'id' => 'view_attendance_button', 'class' => 'btn btn-primary']); ?>
  <?php }else{
      
      echo "No team added to this activity";
      
  } ?>
</div>
<div id="printableArea">
<div id="event_descripion_div" class="pen-title">
    <?php //debug($registeredCandidateLists->event_activity_list->event_list->description);die;
    ?>
    <div class="pen-title">
        <h3>
        <?php if ($registeredCandidatePaginate != '') {
          $EventDescription   = $registeredCandidatePaginate->toArray();
          //debug($EventDescription[0]->event_activity_list->event_list);die;
        ?>
            Attendance Sheet for <?php if (isset($EventDescription[0]->event_activity_list->event_list->description)) {
                                  echo $EventDescription[0]->event_activity_list->event_list->description;
                                } else {
                                    
                                }
                                ?>
        </h3>
        <h4>
            Minimum players present for team completion is :
            <?php 
            echo $teamMinAttendanceCheck;
            ?>
        </h4>
    </div>
</div>

<fieldset>

    <table class="table table-striped" cellpadding="0" cellspacing="0" id="attendance_list">
        <thead>
            <tr>

                <th>S.NO </th>
                <th>Id </th>
                <th>Registration Number</th>
                <th>GameType</th>
                <th>Activity</th>
                <th>Name</th>
                <th>Age</th>
                <th>Weight</th>

                <th>Attendance Status</th>
                <th class="actions"><?= __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>

            <tr>

          <?php 
          $i=1;
          
          foreach ($registeredCandidatePaginate as $registeredCandidateView) : ?>
                <td><?= $i ?></td>
                <td><?= $this->Number->format($registeredCandidateView->id) ?></td>
                <td><?= h($registeredCandidateView->registration_number) ?></td>
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
      endforeach; ?>
        </tbody>

    </table>
    <?= $this->Form->button("Save", ['name' => 'update_attendance_button', 'id' => 'update_attendance_button', 'class' => 'btn btn-primary']);
    ?>
  <?php } else {
          echo '<span color="red">';
          "No record Found";
          '</span>';
        } ?>
  <?= $this->Form->end() ?>


</fieldset>
 </div>
<script>
function printDiv(divName) {

var printContents = document.getElementById(divName).innerHTML;
var originalContents = document.body.innerHTML;

document.body.innerHTML = printContents;

$("#paginator").empty(); 

$('tr').children().eq(9).hide();
 $('table tr').find('td:eq(9)').hide();
 $('table tr').find('td:eq(9)').hide();
window.print();

document.body.innerHTML = originalContents;
}

    $(document).ready(function () {

        $("#update_attendance_button").click(function (e) {
            //  alert('butoonupadte');
            // document.getElementById('event-team-id').value='';
        });
    });
</script>