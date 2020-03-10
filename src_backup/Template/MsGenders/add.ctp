<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MsGender $msGender
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($msGender);
?>
<fieldset>
    <legend><?= __('Add {0}', ['Ms Gender']) ?></legend>

            <div class=col-md-2>
            <?php
            echo $this->Form->control('description');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('point_assigned');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('is_active');
            ?>
        </div>
            
</fieldset>
<?=
   $this->Form->button("Add",['class'=>'btn btn-primary']);
?>
<?= $this->Form->end() ?>
