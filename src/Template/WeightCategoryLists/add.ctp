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
    <legend><?= __('Add {0}', ['Weight Category List']) ?></legend>

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
    $this->Form->button(__("Add"));
?>
<?= $this->Form->end() ?>
