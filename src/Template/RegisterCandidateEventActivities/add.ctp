<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegisterCandidateEventActivity $registerCandidateEventActivity
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($registerCandidateEventActivity);
?>
<fieldset>
    <legend><?= __('Add {0}', ['Register Candidate Event Activity']) ?></legend>

      <div class=col-md-2>
                <?php
                echo $this->Form->input('event_activity_list_id', ['type'=>'select','empty'=>'Select','options' => $eventActivityLists]);
                ?>
            </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('weight');
            ?>
                </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('age');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('active');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('name');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('dob');
            ?>
        </div>
          <div class=col-md-2>
                <?php
                echo $this->Form->input('gender_list_id', ['type'=>'select','empty'=>'Select','options' => $genderLists]);
                ?>
            </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('registration_number');
            ?>
        </div>
            
</fieldset>
<?=
    $this->Form->button(__("Add"));
?>
<?= $this->Form->end() ?>
