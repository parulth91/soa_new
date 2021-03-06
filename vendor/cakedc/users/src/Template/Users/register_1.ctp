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
      
       
<section id="login-bg">
    <div id="login-bg-top">
        <div class="logo-circle"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Hi, you need to Register now! or 
                    <?php
                    $registrationActive = Configure::read('Users.Registration.active');
        if ($registrationActive) {
            echo $this->Html->link(__d('CakeDC/Users', 'Login'), ['action' => 'login']);
        }
                    ?> here!
                        </h3>
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>

    <div class="container">
        <div class="col-md-12">
            <div class="bg-content">
                <div class="input-group">
                    <div class="input-group">
           
<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __d('CakeDC/Users', '') ?></legend>
        <?php
        echo $this->Form->control('username', ['label' => __d('CakeDC/Users', 'Username')]);
        echo $this->Form->control('email', ['label' => __d('CakeDC/Users', 'Email')]);
        echo $this->Form->control('password', ['label' => __d('CakeDC/Users', 'Password')]);
        echo $this->Form->control('password_confirm', [
            'type' => 'password',
            'label' => __d('CakeDC/Users', 'Confirm password')
        ]);
        echo $this->Form->control('first_name', ['label' => __d('CakeDC/Users', 'First name')]);
        echo $this->Form->control('last_name', ['label' => __d('CakeDC/Users', 'Last name')]);
        if (Configure::read('Users.Tos.required')) {
            echo $this->Form->control('tos', ['type' => 'checkbox', 'label' => __d('CakeDC/Users', 'Accept TOS conditions?'), 'required' => true]);
        }
        if (Configure::read('Users.reCaptcha.registration')) {
            echo $this->User->addReCaptcha();
        }
        ?>
    </fieldset>
    <?= $this->Form->button(__d('CakeDC/Users', 'Submit')) ?>
    <?= $this->Form->end() ?>
</div>
        </div>
      

            </div>
        </div>
    </div>
   
   
    <?= $this->Form->end() ?>
</div>
</section>

