<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?= $this->Form->create($user); ?>
<fieldset>
    <legend><?= __('Add {0}', ['User']) ?></legend>
    <?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('username');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('email');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('password');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('first_name');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('last_name');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('token');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('token_expires');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('api_token');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('activation_date');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('tos_date');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('active');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('is_superuser');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('role');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('secret');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('secret_verified');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('dob');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('phone_no');
    ?></div><?php
  ?><div class=col-md-6><?php
    echo $this->Form->control('ms_country_id', ['options' => $msCountries]);
    ?></div><?php
  ?><div class=col-md-6><?php
    echo $this->Form->control('ms_state_id', ['options' => $msStates]);
    ?></div><?php
  ?><div class=col-md-6><?php
    echo $this->Form->control('ms_district_id', ['options' => $msDistricts]);
    ?></div><?php
  ?><div class=col-md-6><?php
    echo $this->Form->control('availability_id', ['options' => $availabilities]);
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('action_ip');
    ?></div><?php
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
