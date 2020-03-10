<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReportingList $reportingList
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($reportingList);
?>
<fieldset>
    <legend><?= __('Add {0}', ['Reporting List']) ?></legend>

      <div class=col-md-2>
                <?php
                echo $this->Form->input('user_id', ['type'=>'select','empty'=>'Select','options' => $users]);
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
