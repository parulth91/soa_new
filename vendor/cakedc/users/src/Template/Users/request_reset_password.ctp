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
<div class="pen-title">
  <h1>Reset Password</h1>
</div>
<div class="rerun"> <?php
       
            echo $this->Html->link(__d('CakeDC/Users', 'Login Here !'), ['action' => 'login']);
       
        ?></div>
<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">Reset Password</h1>
    

                        <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create('User') ?>
        
      <div class="input-container">
        
                            <?= $this->Form->control('reference',
                                    ['label' => false,'placeholder'=>'Enter Email', 'required' => true]) ?>
        <label for="#{label}"></label>
        <div class="bar"></div>
      </div>
      
      <div class="button-container">
        <span>
                <?= $this->Form->button(__d('CakeDC/Users', '<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Verify'), ['class' => 'btn btn-primary']); ?>
        </span>
      </div>
      <div class="footer">
       
      </div>
   
    <?= $this->Form->end() ?>
  </div>
</div>

<!--
<?php
//$this->extend('/Layout/TwitterBootstrap/signin');
?>
<div class="users form">
   
</div>-->
