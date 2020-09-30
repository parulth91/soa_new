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
<?php echo $this->Form->create('submit_form', ['id' => 'submit_form', 'type' => 'post']); 
echo $this->Form->button('print', [
    'name'=>'print',
   'value'=>'print',
   'id'=> "print",
  'class' => 'btn btn-primary']);?>
</div>
</div>
<?= $this->Form->end() ?>
    <?php
    if (isset($registeredCandidatePaginate)) {
      $registeredCandidatePaginate = $registeredCandidatePaginate;
    } else {
      $registeredCandidatePaginate = 0;
    }
    ?>
   
    <div id="event_descripion_div" class="pen-title">
  
    <div class="pen-title">
      <h3>
        <?php  if(isset($registerCandidateEventActivities)) {
          $EventDescription   = $registerCandidateEventActivities->toArray();
         // debug($EventDescription);//die;
        ?>
          Registered Candidate for <?php if (isset($EventDescription[0]->event_activity_list->description)) {
                                  echo $EventDescription[0]->event_activity_list->description;
                                } else {
                                    
                                } }
                                ?>
      </h3>
    </div>
  </div>

  <fieldset>
<table class="table table-striped" cellpadding="0" cellspacing="0">
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
            <th><?= $this->Paginator->sort('weight'); ?></th>
            <th><?= $this->Paginator->sort('age'); ?></th>
            <th><?= $this->Paginator->sort('event_qualifying_status'); ?></th>
            <th><?= $this->Paginator->sort('attendance_status'); ?></th>
            <th><?= $this->Paginator->sort('certificate_download_status'); ?></th>
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
