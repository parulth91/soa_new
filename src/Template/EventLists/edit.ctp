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
    <legend><?= __('Edit {0}', ['Event List']) ?></legend>

            <div class=col-md-2>
            <?php
            echo $this->Form->control('event_year');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('description');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('registration_start_date');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('registration_end_date');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('event_start_date');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('event_end_date');
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
