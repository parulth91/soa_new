<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<?php echo $this->Form->create('attendance_form', ['id' => 'submit_form', 'type' => 'post']); ?>
  <div class = "pen-title">
  <?php //debug($registeredCandidateLists->event_activity_list->event_list->description);die;?>
         <div class = "pen-title"> <h3 > 
                <?php  if(!empty($registeredCandidatePaginate)){
                           $EventDescription   =$registeredCandidatePaginate->toArray();              
                         //debug($EventDescription[0]->event_activity_list->event_list);die;?>
                       Attendance Sheet for <?php echo $EventDescription[0]->event_activity_list->event_list->description;} 
                    else     {
                    echo'NoRecord found';                                   
                    }
                  ?> 
        </h3></div>
    </div>
<fieldset>
<table class="table table-striped" cellpadding="0" cellspacing="0">
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
          <?php 
              foreach ($registeredCandidatePaginate as $registeredCandidateView):?>
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
            
  // echo $this->Form->input('attendance_status[]', [
           // 'label' => false,
            // 'value'=>'true',     
           // 'type' => 'checkbox',
          //  'id' => 'attendance_status',
          //             'selected' => $registeredCandidateView->id,
           // 'autocomplete' => "off",
      //  ])
     
      ?>
        </tr>
            <?php endforeach; ?>
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

<div>

<?= $this->Form->button(__("Submit")); ?>
<?= $this->Form->end() ?>