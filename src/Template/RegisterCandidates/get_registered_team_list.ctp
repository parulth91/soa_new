
<div style="float:right;">
<div class="topmargin30">
<input type="button" onclick="printDiv('printableArea')" value="Print"class="btn btn-primary" />
</div>
</div>
<div id="printableArea">
    <div id="event_descripion_div" class="pen-title">
        <?php //debug($registeredCandidateLists->event_activity_list->event_list->description);die;
        ?>
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
            <!-- <h4>
              //   Minimum players present for team completion is :
                <?php 
            //   echo $teamMinAttendanceCheck;
                ?>
            </h4>-->
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
        <th id="actionhead" class="actions">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php //if($registerCandidateEventActivities){
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
            <td><?= $this->Number->format($registerCandidateEventActivity->weight) ?></td>
          <td><?= $this->Number->format($registerCandidateEventActivity->age) ?></td>
         <td><?= $registerCandidateEventActivity->event_qualifying_status ? __('Yes') : __('No'); ?></td>
         <td><?= $registerCandidateEventActivity->attendance_status ? __('Yes') : __('No'); ?></td>
         <td><?= $registerCandidateEventActivity->certificate_download_status ? __('Yes') : __('No'); ?></td>

         <td class="actions" id="action-div">
        <?= $this->Html->link('', ['action' => 'view', $registerCandidateEventActivity->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
        <?= $this->Html->link('', ['action' => 'edit', $registerCandidateEventActivity->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
         </td>
        </tr>
      <?php  
      $i++;
      endforeach; ?>
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