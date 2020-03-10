<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($user);
?>
<fieldset>
    <legend><?= __('Add {0}', ['User']) ?></legend>

            <div class=col-md-2>
            <?php
            echo $this->Form->control('username');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('email');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('password');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('first_name');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('last_name');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('token');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('token_expires');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('api_token');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('activation_date');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('tos_date');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('active');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('is_superuser');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('role');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('secret');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('secret_verified');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('dob');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('phone_no');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('password_changed');
            ?>
        </div>
       
            
</fieldset>
<?=
    $this->Form->button(__("Add"));
?>
<?= $this->Form->end() ?>
