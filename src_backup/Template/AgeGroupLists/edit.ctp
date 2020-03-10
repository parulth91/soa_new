<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AgeGroupList $ageGroupList
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($ageGroupList);
?>
<fieldset>
    <legend><?= __('Edit {0}', ['Age Group List']) ?></legend>

            <div class=col-md-2>
            <?php
            echo $this->Form->control('description');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('minimum_age');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('maximum_age');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('is_active');
            ?>
        </div>
            
</fieldset>
<?=
    $this->Form->button(__("Save"));
?>
<?= $this->Form->end() ?>
