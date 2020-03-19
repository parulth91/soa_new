<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
   <?php echo $this->Form->create('team_list_form', ['id' => 'team_form', 'type' => 'post']); ?>
<?php
if(!empty($teamDetails)){
  ?>
<div class="row">

    
<fieldset>
  <div class=col-md-5>
    <?php
  //  if ($eventActivityListValue->activity_list->game_type_list->description != 'Individual') {
    
    echo $this->Form->input('event_team_id', [
        'type' => 'select',
        'label' => 'Select Team',
        'empty' => true,
        'options' => $teamDetails,
         'required' => 'true']);
    ?>
  </div>
</fieldset>>
  <?= $this->Form->button("View Attendance List",['name'=>'view_attendance_button','id'=>'view_attendance_button','class'=>'btn btn-primary']); ?>
<?php }?>
</div>    
<div id="event_descripion_div" class = "pen-title">
  <?php //debug($registeredCandidateLists->event_activity_list->event_list->description);die;?>
         <div  class = "pen-title"> <h3 > 
                <?php 
                       //   $EventDescription   =$registeredCandidatePaginate->toArray();              
                         //debug($EventDescription[0]->event_activity_list->event_list);die;?>
                      Attendance Sheet for <?php if(isset($EventDescription[0]->event_activity_list->event_list->description)){
                                 echo $EventDescription[0]->event_activity_list->event_list->description;} 
                   else     {
                                                       
                    }
                  ?> 
        </h3></div>
    </div>

<fieldset>
 
<table class="table table-striped" cellpadding="0" cellspacing="0" id="attendance_list">
    <thead>
        <tr>
         
            <th><?= $this->Paginator->sort('S.NO'); ?></th>
            <th><?= $this->Paginator->sort('GameType'); ?></th>
            <th><?= $this->Paginator->sort('Activity'); ?></th>
             <th><?= $this->Paginator->sort('Name'); ?></th>
            <th><?= $this->Paginator->sort('Age'); ?></th>
             <th><?= $this->Paginator->sort('Weight'); ?></th>
            <th><?= $this->Paginator->sort('Registration Number'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
     
        <tr>
           <?php foreach ($registeredCandidatePaginate as $registeredCandidateView):?>
            <td><?= $this->Number->format($registeredCandidateView->id) ?></td>
            <td>
                <?= $registeredCandidateView->event_activity_list->activity_list->game_type_list->description;?>
            </td>
            <td> <?= $registeredCandidateView->event_activity_list->activity_list->description;?></td>
            <td><?= $registeredCandidateView->full_name; ?></td>
                        <td><?= $registeredCandidateView->age;  ?></td>
                        <td><?=  $registeredCandidateView->weight;  ?></td>
            <td><?= h($registeredCandidateView->registration_number) ?></td>
        
           <?php     echo '<td class="actions">'.$this->Form->checkbox('attendance_status.'.$registeredCandidateView->id.'.checkid', 
                       array('value'=>"$registeredCandidateView->id ")).'</td>';
      ?>
        </tr>
            <?php endforeach;  ?>
    </tbody>
 
</table>
  
<?= $this->Form->button(__("Submit")); ?>
<?= $this->Form->end() ?>
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

<script type="text/javascript">
    
    $(document).ready(function () {
        //alert('ff');
        $("#view_attendance_button"). click(function (e) {
        var event_team_id=document.getElementById('event_team_id').value;
        if(event_team_id!=''){
            alert('dfd');
        $('#event_descripion_div').show();
        $('#attendance_list').show();
         $('.paginator').show();}
  
     else{
           $('#event_descripion_div').hide();
        $('#attendance_list').hide();
         $('.paginator').hide();
     }
        



    });
    });
</script>

