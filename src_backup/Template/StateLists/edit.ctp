<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StateList $stateList
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($stateList);
?>
<fieldset>
    <legend><?= __('Edit {0}', ['State List']) ?></legend>

            <div class=col-md-2>
            <?php
            echo $this->Form->control('description');
            ?>
        </div>
          <div class=col-md-2>
                <?php
                echo $this->Form->input('country_list_id', ['type'=>'select','empty'=>'Select','options' => $countryLists]);
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
