<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php echo $this->Form->create('team_list_form'); ?>
<?php
if (!empty($teamDetails)) {
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
  <?php } ?>
  </div>
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
    </div>
  </div>

  <fieldset>

    <table class="table table-striped" cellpadding="0" cellspacing="0" id="attendance_list">
      <thead>
        <tr>

          <th>S.NO </th>
          <th>GameType</th>
          <th>Activity</th>
          <th>Name</th>
          <th>Age</th>
          <th>Weight</th>
          <th>Registration Number</th>
          <th>Attendance Status</th>
          <th class="actions"><?= __('Actions'); ?></th>
        </tr>
      </thead>
      <tbody>

        <tr>

          <?php foreach ($registeredCandidatePaginate as $registeredCandidateView) : ?>
            <td><?= $this->Number->format($registeredCandidateView->id) ?></td>
            <td>
              <?= $registeredCandidateView->event_activity_list->activity_list->game_type_list->description; ?>
            </td>
            <td> <?= $registeredCandidateView->event_activity_list->activity_list->description; ?></td>
            <td><?= $registeredCandidateView->full_name; ?></td>
            <td><?= $registeredCandidateView->age;  ?></td>
            <td><?= $registeredCandidateView->weight;  ?></td>
            <td><?= h($registeredCandidateView->registration_number) ?></td>
            <td><?php if ($registeredCandidateView->attendance_status == 'true') {
                  echo $registeredCandidateView->attendance_status;
                } else {
                  echo '0';
                }
                ?></td>
            <td class="actions"><?php echo $this->Form->checkbox(
                                  'attendance_status' . "[$registeredCandidateView->id]" . '[checkid]',
                                  ['value' => "$registeredCandidateView->id "]
                                ); ?></td>
        </tr>
      <?php endforeach; ?>
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
  <script>
    //             for datepicker
    $(document).ready(function() {
      $("#update_attendance_button").click(function(e) {
      //  alert('butoonupadte');
        // document.getElementById('event-team-id').value='';
      });
    });
  </script>