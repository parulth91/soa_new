<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventActivityList $eventActivityList
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($eventActivityList);
?>
<fieldset>
    <legend><?= __('Add {0}', ['Event Activity List']) ?></legend>

           <div class=col-md-2> 
             <?php
                echo $this->Form->input('event_lists_id',['type'=>'select','empty'=>'Select','options' => $eventLists]);
                ?>
        </div>
        <div class=col-md-2>
             <?php
                echo $this->Form->input('activity_lists_id',['type'=>'select','empty'=>'Select','options' => $activityLists]);
                ?>
        </div>
         
      <div class=col-md-2>
           <?php
              echo $this->Form->control('is_active');
           ?>
       </div>   
</fieldset>
  <div align="left">
   <?=
     $this->Form->button("Add",['class'=>'btn btn-primary']);
 ?>
    </div>
<?= $this->Form->end() ?>
