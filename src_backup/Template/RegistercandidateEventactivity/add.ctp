<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistercandidateEventactivity $registercandidateEventactivity
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($registercandidateEventactivity);
?>
<fieldset>
    <legend><?= __('Add {0}', ['Registercandidate Eventactivity']) ?></legend>

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
            
</fieldset>
<?=
    $this->Form->button(__("Add"));
?>
<?= $this->Form->end() ?>
