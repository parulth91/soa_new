<?php

/**
 * Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
use Cake\Core\Configure;

$this->extend('/Layout/TwitterBootstrap/signin');
?>
<!-- Mixins-->
<!-- Pen Title-->
<!--<div class="pen-title">
    <h1>VMS Registration</h1>
</div>-->
<div class="rerun"> <?php
    echo $this->Html->link(__d('CakeDC/Users', 'Already Signed Up User!'), ['action' => 'login']);
    ?></div>
<div class="container">
    <div class="card alt"></div>
    <div class="card">
        <h1 class="title">Sign Up</h1>
       <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __d('CakeDC/Users', '') ?></legend>

        <div class="input-container">
            <?= $this->Form->control('username', ['label' => false, 'placeholder' => 'Username', 'required' => true]) ?>
            
            <div class="bar"></div>

            <?= $this->Form->control('email', ['label' => false,
                'placeholder' => 'Email', 'required' => true])
            ?>
           
          
        </div>
        <div class="input-container">
<?= $this->Form->control('password', ['label' => false, 'placeholder' => 'Password', 'required' => true]) ?>
           

            <?=
            $this->Form->control('password_confirm', [
                'type' => 'password',
                'label' => false, 'placeholder' => 'Confirm Password', 'required' => true])
            ?>
           
            <div class="bar"></div>
        </div>
        <div class="input-container">
            <?=
            $this->Form->control('first_name', [
                'type' => 'text',
                'label' => false, 'placeholder' => 'First Name', 'required' => true])
            ?>

            <?=
            $this->Form->control('last_name', [
                'type' => 'text',
                'label' => false, 'placeholder' => 'Last Name', 'required' => true])
            ?>
           
            <div class="bar"></div>
        </div>
        <div class="button-container">
            <?php
            if (Configure::read('Users.reCaptcha.login')) {
                echo $this->User->addReCaptcha();
            }
            if (Configure::read('Users.Tos.required')) {
                echo $this->Form->control('tos', ['type' => 'checkbox', 'label' => __d('CakeDC/Users', 'Accept TOS conditions?'), 'required' => true]);
            }
            ?>

        </div>
        <div class="button-container">
            <span><?= $this->Form->button(__d('CakeDC/Users', 'Submit')); ?></span>
        </div>
        <div class="footer">

        </div>

<?= $this->Form->end() ?>
    </div>
</div>

