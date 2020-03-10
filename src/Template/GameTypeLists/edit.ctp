<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GameTypeList $gameTypeList
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($gameTypeList);
?>
<fieldset>
    <legend><?= __('Edit {0}', ['Game Type List']) ?></legend>

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
    $this->Form->button(__("Save"));
?>
<?= $this->Form->end() ?>
