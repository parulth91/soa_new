<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventTeamDetail $eventTeamDetail
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($eventTeamDetail);
?>
<fieldset>
    <legend><?= __('Add {0}', ['Event Team Detail']) ?></legend>

            <div class=col-md-2>
            <?php
            echo $this->Form->control('description');
            ?>
        </div>
          <div class=col-md-2>
                <?php
                echo $this->Form->input('event_activity_list_id', ['type'=>'select','empty'=>'Select','options' => $eventActivityLists]);
                ?>
            </div>
          <div class=col-md-2>
                <?php
                echo $this->Form->input('state_list_id', ['type'=>'select','empty'=>'Select','options' => $stateLists]);
                ?>
            </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('active');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('attendance_status');
            ?>
        </div>
            
</fieldset>
<?=
    $this->Form->button(__("Add"));
?>
<?= $this->Form->end() ?>
