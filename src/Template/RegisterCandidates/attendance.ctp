
<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<?php echo $this->Form->create('attendance_form', ['id' => 'submit_form', 'type' => 'post']); ?>
  <div class = "pen-title">
  <?php //debug($registeredCandidateLists->event_activity_list->event_list->description);die;?>
         <div class = "pen-title"> <h3 > 
                <?php foreach ($registeredCandidatePaginate as $registeredCandidateView){
                    //debug($registeredCandidateView);?>
                   Attendance Sheet for <?php echo $registeredCandidateView->event_activity_list->event_list->description; }//die;                                     
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
        
            <td class="actions">
                
              <?php echo $this->Form->input('attendance_status[]', [
            'label' => false,
             'value'=>'1',     
            'type' => 'checkbox',
            'id' => 'attendance_status',
                       'selected' => $registeredCandidateView->id,
            'autocomplete' => "off",
        ]);?>
            </td>
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