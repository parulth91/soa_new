<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CountryList $countryList
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($countryList);
?>
<fieldset>
    <legend><?= __('Add {0}', ['Country List']) ?></legend>

            <div class=col-md-2>
            <?php
            echo $this->Form->control('description');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('country_code');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('flag_code');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('telephone_code');
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
