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
         $event_year=$eventList->event_year;
   $registration_start_date=date('d/m/Y',strtotime($eventList->registration_start_date));
   $registration_end_date=date('d/m/Y',strtotime($eventList->registration_end_date));
   $event_start_date=date('d/m/Y',strtotime($eventList->event_start_date));
   $event_end_date=date('d/m/Y',strtotime($eventList->event_end_date));
?>
<fieldset>
    <legend><?= __('Edit {0}', ['Event List']) ?></legend>

            <div class=col-md-2>
            <?php
             echo $this->Form->input('event_year', ['label' => true,
             'id' => 'event_year',
             'type'=>'year',
             'minYear' => date('Y'),
             'maxYear' => date('Y')+10,
             'orderYear' => 'asc',
             'empty'     => false,
             'placeholder'=>'Year',
             'value'=>$event_year
         ]);         
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('description');
            ?>
        </div>
                <div class=col-md-2>
            <?php
           echo $this->Form->input('registration_start_date', ['label' => true,
           'id' => 'registration_start_date',
         'class'=>'datepicker',
           'type' => 'text',
           'maxlength' => 10,
           //'oninput' => "setCustomValidity('')",
           'placeholder' => "dd-mm-yyyy", "onkeyup" => "return validateDate(this);",
           'required' => 'true',
           'autocomplete' => "off",
           'value'=>$registration_start_date
       ]);
            ?>
        </div>
                <div class=col-md-2>
            <?php
             echo $this->Form->input('registration_end_date', ['label' => true,
             'id' => 'registration_end_date',
           'class'=>'datepicker',
             'type' => 'text',
             'maxlength' => 10,
             //'oninput' => "setCustomValidity('')",
             'placeholder' => "dd-mm-yyyy", "onkeyup" => "return validateDate(this);",
             'required' => 'true',
             'autocomplete' => "off",
             'value'=>$registration_end_date
         ]);
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->input('event_start_date', ['label' => true,
            'id' => 'event_start_date',
          'class'=>'datepicker',
            'type' => 'text',
            'maxlength' => 10,
            //'oninput' => "setCustomValidity('')",
            'placeholder' => "dd-mm-yyyy", "onkeyup" => "return validateDate(this);",
            'required' => 'true',
            'autocomplete' => "off",
            'value'=>$event_start_date
        ]);
            ?>
        </div>
                <div class=col-md-2>
            <?php
             echo $this->Form->input('event_end_date', ['label' => true,
             'id' => 'event_end_date',
           'class'=>'datepicker',
             'type' => 'text',
             'maxlength' => 10,
             //'oninput' => "setCustomValidity('')",
             'placeholder' => "dd-mm-yyyy", "onkeyup" => "return validateDate(this);",
             'required' => 'true',
             'autocomplete' => "off",
             'value'=>$event_end_date
         ]);
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('active');
            ?>
        </div>
            
</fieldset>
<?=
    $this->Form->button(__("Save"));
?>
<?= $this->Form->end() ?>

<script type="text/javascript">
    //             for datepicker
    $(document).ready(function () {

  $("#event_start_date").datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: 0
          //      inline:true,
             //   timeFormat: 'hh:mm TT'
               
            });
            $("#event_end_date").datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: 0
               
            });  
            $("#registration_start_date").datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: 0
               
            });  
            $("#registration_end_date").datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: 0
               
            });  
            
            
            var startDate = new Date($('#event_start_date').val());
            var endDate = new Date($('#event_end_date').val());

            if (startDate < endDate){
               alert('End date must be less than start date')
            }
           
        });
</script>
        