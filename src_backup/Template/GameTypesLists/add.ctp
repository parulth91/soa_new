<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GameTypesList $gameTypesList
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($gameTypesList);
?>
<fieldset>
    <legend><?= __('Add {0}', ['Game Types List']) ?></legend>

            <div class=col-md-5>
            <?php
            echo $this->Form->control('description');
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
