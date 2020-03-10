<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SocialAccount $socialAccount
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?= $this->Form->create($socialAccount); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Social Account']) ?></legend>
    <?php
  ?><div class=col-md-6><?php
    echo $this->Form->control('user_id', ['options' => $users]);
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('provider');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('username');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('reference');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('avatar');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('description');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('link');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('token');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('token_secret');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('token_expires');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('active');
    ?></div><?php
            ?><div class=col-md-6><?php
    echo $this->Form->control('data');
    ?></div><?php
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
