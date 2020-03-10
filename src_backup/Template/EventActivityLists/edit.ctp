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
    <legend><?= __('Edit {0}', ['Event Activity List']) ?></legend>

            <div class=col-md-2>
            <?php
            echo $this->Form->control('description');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('is_active');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('event_lists_id');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('activity_lists_id');
            ?>
        </div>
            
</fieldset>
<?=
    $this->Form->button(__("Save"));
?>
<?= $this->Form->end() ?>
