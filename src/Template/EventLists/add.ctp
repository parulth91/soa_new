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

            <div class=col-md-2>
            <?php 
           echo $this->Form->control('event_year', ['label' => true,
           'id' => 'event_year',
           'type'=>'year',
           'minYear' => date('Y'),
           'maxYear' => date('Y')+10,
           'orderYear' => 'asc',
           'empty'     => false,
           'placeholder'=>'Year'
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
    $this->Form->button(__("Add"));
?>
<?= $this->Form->end() ?>

<script type="text/javascript">
    //             for datepicker
    $(document).ready(function () {
       // alert('ds');
  $("#event_start_date").datepicker({
                minDate: 0,
                maxDate: "+60D",
                dateFormat: 'dd-mm-yy',
                onSelect: function(selected) {
                  $("#event_end_date").datepicker("option","minDate", selected)
           }
           
            });
            $("#event_end_date").datepicker({
                 minDate: 0,
                 maxDate:"+60D",
                 dateFormat: 'dd-mm-yy',
                 onSelect: function(selected) {
                    $("#event_start_date").datepicker("option","maxDate", selected)
                }
            });  
            $("#registration_start_date").datepicker({
                minDate: 0,
                maxDate: "+60D",
                dateFormat: 'dd-mm-yy',
                onSelect: function(selected) {
                  $("#registration_end_date").datepicker("option","minDate", selected)
           }
               
            });  
            $("#registration_end_date").datepicker({
                minDate: 0,
                 maxDate:"+60D",
                 dateFormat: 'dd-mm-yy',
                 onSelect: function(selected) {
                    $("#registration_end_date").datepicker("option","maxDate", selected)
                }
               
            });      
             // $("#event_start_date").timePicker({
  //    startTime: "09:00",
    //  endTime: "17:00",
    //  show24Hours: true,
    //  separator: ':',
    //  step: 20
  //  });
          
        });
</script>
        