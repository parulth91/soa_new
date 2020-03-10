<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\WeightCategoryList $weightCategoryList
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($weightCategoryList);
?>
<fieldset>
    <legend><?= __('Edit {0}', ['Weight Category List']) ?></legend>

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
            echo $this->Form->control('maximum_weight');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('minimum_weight');
            ?>
        </div>
            
</fieldset>
<?=
    $this->Form->button(__("Save"));
?>
<?= $this->Form->end() ?>
