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
            echo $this->Form->control('full_name');
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
          <div class=col-md-2>
                <?php
                echo $this->Form->input('event_team_detail_id', ['type'=>'select','empty'=>'Select','options' => $eventTeamDetails]);
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
            echo $this->Form->control('event_qualifying_status');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('attendance_status');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('certificate_download_status');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('active');
            ?>
        </div>
          <div class=col-md-2>
                <?php
                echo $this->Form->input('state_list_id', ['type'=>'select','empty'=>'Select','options' => $stateLists]);
                ?>
            </div>
          <div class=col-md-2>
                <?php
                echo $this->Form->input('result_status_list_id', ['type'=>'select','empty'=>'Select','options' => $resultStatusLists]);
                ?>
            </div>
            
</fieldset>
<?=
    $this->Form->button(__("Add"));
?>
<?= $this->Form->end() ?>
