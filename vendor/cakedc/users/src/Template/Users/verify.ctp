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
echo $this->Html->link(__d('CakeDC/Users', 'Login Here !'), ['action' => 'login']);
?></div>
<div class="container">
    <div class="card alt"></div>
    <div class="card">
        <h1 class="title">Input Your Authenticator Code</h1>
 <?= $this->Form->create() ?>

                        <?= $this->Flash->render('auth') ?>
                        <?= $this->Flash->render() ?>

        <div class="input-container">
        <?php if (!empty($secretDataUri)): ?>
                                <p class='text-center'><img src="<?php echo $secretDataUri; ?>"/></p>
                                <?php endif; ?>
                                
            <label for="#{label}"></label>
            <div class="bar"></div>
        </div>
        <div class="input-container">
        
                                <?= $this->Form->control('code', ['required' => true, 'label' => false, 'placeholder'=>'Enter your 6 digit code!']) ?>
            <label for="#{label}"></label>
            <div class="bar"></div>
        </div>
       
        <div class="button-container">
 <?= $this->Form->button(__d('CakeDC/Users', '<span class="glyphicon glyphicon-log-in" aria-hidden="true">  Verify</span> Verify'), ['class' => 'btn btn-primary']); ?>
                       
        </div>
        <div class="footer"><p style="color: red;">
Download Google Authenticator app from Play Store and use it to authenticate.
        </div>

            <?= $this->Form->end() ?>
    </div>
</div>

