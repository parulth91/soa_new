<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventList $eventList
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($eventList);
?>
<fieldset>
    <legend><?= __('Add {0}', ['Event List']) ?></legend>
   <div class="form-group row">
     <div class="col-sm-2">
            <?php
        // echo $this->Form->control('event_year');
          //    echo $this->Form->control('event_year');
            echo $this->Form->control('event_year', array(
            'label' => 'Event Year',
           // 'dateFormat' => 'Y',
            'Year' => date('Y'),
            //'maxYear' => date('Y') - 18,
));
            ?>
        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       
         <div class="col-sm-5">
            <?php
            echo $this->Form->control('description');
            ?>
        </div>
      </div>   
       <div class="form-group row">
           <div class="col-sm-5">
            <?php      
            echo $this->Form->control('registration_start_date');
            ?>
        </div>
           <div class="col-sm-5">
                <?php
             /*   echo $this->Form->date('registered', [
            'minYear' => 2018,
            'monthNames' => false, // Months are displayed as numbers
            'empty' => [
                'year' => false, // The year select control has no option for empty value
                'month' => 'Choose month...', // The month select control does, though
            ],
            'day' => false, // Do not show day select control
            'year' => [
                'class' => 'cool-years',
                'title' => 'Registration Year'
            ]
        ]);*/
         echo $this->Form->control('registration_end_date');
            ?>
    </div>
    </div>
   <div class="form-group row">
           <div class="col-sm-5">
            <?php
            echo $this->Form->control('event_start_date');
            ?>
        </div>
    
           <div class="col-sm-5">
            <?php
            echo $this->Form->control('event_end_date');
            ?>
        </div>
   </div>   
      <div class="form-group row">
           <div class="col-sm-5">
            <?php
            echo $this->Form->control('is_active');
            ?>
        </div>
      </div>
            
</fieldset>
<div align="center">
<?=
    $this->Form->button("Add",['class'=>'btn btn-primary']);
?>
    </div>
<?= $this->Form->end() ?>
