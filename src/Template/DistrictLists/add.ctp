<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DistrictList $districtList
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($districtList);
?>
<fieldset>
    <legend><?= __('Add {0}', ['District List']) ?></legend>

            <div class=col-md-2>
            <?php
            echo $this->Form->control('description');
            ?>
        </div>
          <div class=col-md-2>
                <?php
                echo $this->Form->input('state_list_id', ['type'=>'select','empty'=>'Select','options' => $stateLists]);
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
