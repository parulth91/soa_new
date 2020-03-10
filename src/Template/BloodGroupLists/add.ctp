<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BloodGroupList $bloodGroupList
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($bloodGroupList);
?>
<fieldset>
    <legend><?= __('Add {0}', ['Blood Group List']) ?></legend>

            <div class=col-md-2>
            <?php
            echo $this->Form->control('description');
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
