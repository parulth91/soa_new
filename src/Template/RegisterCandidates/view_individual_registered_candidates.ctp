<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

//echo $this->Form->button('export', [
  // 'value'=>'export_excel',
  // 'id'=> "export_excel",
  //'class' => 'btn btn-primary']);
  ?>
<div style="float:right;">
<div class="topmargin30">
<input type="button" onclick="printDiv('printableArea')" value="Print"class="btn btn-primary" />
</div>
</div>
<div class="row">
<?= $this->Form->end() ?>

   <div id="printableArea">
    <div id="event_descripion_div" class="pen-title">
  
    <div class="pen-title">
      <h3>
        <?php if(isset($registerCandidateEventActivities))
        {
             $registerCandidateEventActivities =$registerCandidateEventActivities;
             $query_count = count($registerCandidateEventActivities);
         if($query_count)         
            {              
                    $EventDescription   = $registerCandidateEventActivities->toArray();
                  // debug($EventDescription);//die;
                  ?>
                    Registered Candidate for <?php if (isset($EventDescription[0]->event_activity_list->description)) {
                                            echo $EventDescription[0]->event_activity_list->description;
                                        }
                                       else {
                                              
                                          } 
                                          ?>
                </h3>
              </div>
            </div>

            <fieldset>

            <table class="table table-striped" cellpadding="0" cellspacing="0" id="candidate_list">

              <thead>
                  <tr>
                      <th>S.NO </th>
                      <th> Id</th>
                      <th>Event Activity</th>
                      <th>Full Name</th>
                      <th>DOB</th>
                      <th>Gender</th>
                      <th>Registration Number</th>
                      <th>State</th>
                      <th>Weight</th>
                      <th>Age </th>
                      <th>Event Qualifying Status </th>
                      <th>Attendance Status </th>
                      <th>Certificate Download Status </th>
                      <th class="actions"><?= __('Actions'); ?></th>
                  </tr>
              </thead>
              <tbody>
                  <?php 
                  $i=1;
                  foreach ($registerCandidateEventActivities as $registerCandidateEventActivity): ?>
                  <tr>
                      <td><?php echo $i; ?></td>
                      <td><?= $this->Number->format($registerCandidateEventActivity->id) ?></td>
                      <td>
                          <?= h($registerCandidateEventActivity->event_activity_list->description) ?>
                      </td>
                      <td><?= h($registerCandidateEventActivity->full_name) ?></td>
                      <td><?php echo date_format($registerCandidateEventActivity->dob,"d/m/Y");?></td>
                      <td>
                          <?= h($registerCandidateEventActivity['gender_list']['description']) 
                          //= $registerCandidateEventActivity->has('gender_list') ? $this->Html->link($registerCandidateEventActivity->gender_list->description, ['controller' => 'GenderLists', 'action' => 'view', $registerCandidateEventActivity->gender_list->id]) : '' ?>
                      </td>
                      <td><?= h($registerCandidateEventActivity->registration_number) ?></td>
                      <td><?= h($registerCandidateEventActivity['state_list']['description']) ?></td>
                    
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
                  endforeach;
                ?>
              </tbody>
          </table>
  <?php }
      else{
        ?><h4 style="color:red; text-align:center;   outline: 2px solid red;">No record Found</h4>
   <?php   }
      }
        else {
        }?>  
</fieldset>


<div>
<div>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;
     $('tr').children().eq(13).hide();
      $('table tr').find('td:eq(13)').hide();
     $("#paginator").empty(); 
     window.print();

     document.body.innerHTML = originalContents;
}
$(document).ready(function() {
  if(document.getElementById("state_list_id").value =="" )
  {
     $(".pen-title").hide();
      $("#candidate_list").hide();
  }
    $("#view_state_button").click(function(){
    if(document.getElementById("state_list_id").value =="" )
     {
      $(".pen-title").hide();
      $("#candidate_list").hide();
   }
 
  });
 }); 
</script>