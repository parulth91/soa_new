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
$this->extend('/Layout/TwitterBootstrap/admindashboard');
$Users = ${$tableAlias};
?>

<div class="users form col-md-12">
    <div class='row'>
       
    <?= $this->Form->create($Users); ?>
    <fieldset>
        <legend><?= __d('CakeDC/Users', 'Edit User') ?></legend>
        <div class="col-md-6">
            <?php
echo $this->Form->control('username', ['label' => __d('CakeDC/Users', 'Username')]);            
            ?>
        </div>
        <div class="col-md-6">
            <?php
             echo $this->Form->control('email', ['label' => __d('CakeDC/Users', 'Email')]);
            ?>
        </div>
        <div class="col-md-6">
            <?php
            
        echo $this->Form->control('first_name', ['label' => __d('CakeDC/Users', 'First name')]);
            ?>
        </div>
        <div class="col-md-6">
            <?php
            
          echo $this->Form->control('last_name', ['label' => __d('CakeDC/Users', 'Last name')]);
            ?>
        </div>
        <div class="col-md-6">
            <?php
            
         echo $this->Form->control('token', ['label' => __d('CakeDC/Users', 'Token')]);
            ?>
        </div>
        <div class="col-md-6">
            <?php
             echo $this->Form->control('token_expires', [
            'label' => __d('CakeDC/Users', 'Token expires')
        ]);
       
            ?>
        </div>
        <div class="col-md-6">
            <?php
            
        echo $this->Form->control('api_token', [
            'label' => __d('CakeDC/Users', 'API token')
        ]);
            ?>
        </div>
        <div class="col-md-6">
            <?php
            
        echo $this->Form->control('activation_date', [
            'label' => __d('CakeDC/Users', 'Activation date')
        ]);
            ?>
        </div>
        <div class="col-md-6">
            <?php
            
       
        echo $this->Form->control('tos_date', [
            'label' => __d('CakeDC/Users', 'TOS date')
        ]);
            ?>
        </div>
        <div class="col-md-6">
            <?php
            
         echo $this->Form->control('active', [
            'label' => __d('CakeDC/Users', 'Active')
        ]);
            ?>
        </div>
            
    </fieldset>
        </div>
    <?= $this->Form->button(__d('CakeDC/Users', 'Submit')) ?>
    <?= $this->Form->end() ?>
    <?php if (Configure::read('Users.GoogleAuthenticator.login')) : ?>
        <fieldset>
            <legend>Reset Google Authenticator</legend>
            <?= $this->Form->postLink(
                __d('CakeDC/Users', 'Reset Google Authenticator Token'), [
                'plugin' => 'CakeDC/Users',
                'controller' => 'Users',
                'action' => 'resetGoogleAuthenticator', $Users->id
            ], [
                'class' => 'btn btn-danger',
                'confirm' => __d(
                    'CakeDC/Users',
                    'Are you sure you want to reset token for user "{0}"?', $Users->username
                )
            ]);
            ?>
        </fieldset>
    <?php endif; ?>
</div>
