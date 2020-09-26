<?php
use Cake\Core\Configure;
$this->extend('/Layout/TwitterBootstrap/signin');
?>
 
<!-- Mixins-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>SOA Login</h1>
</div>
<div class="rerun"> <?php
        $registrationActive = Configure::read('Users.Registration.active');
        if ($registrationActive) {
            echo $this->Html->link(__d('CakeDC/Users', 'Sign Up Here !'), ['action' => 'register']);
        } 
        ?></div>
<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">Login</h1>
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
        
      <div class="input-container">
        <?= $this->Form->control('username', ['label' => false,'placeholder'=>'Username', 'required' => true]) ?>
        <label for="#{label}"></label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <?= $this->Form->control('password', ['label' => false,'placeholder'=>'Password', 'required' => true]) ?>
        <label for="#{label}"></label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <?php
        if (Configure::read('Users.reCaptcha.login')) {
            echo $this->User->addReCaptcha();
        }
        ?>
<!--        <script src="https://authedmine.com/lib/captcha.min.js" async></script>
                            <script>
		function myCaptchaCallback(token) {
			alert('Captcha verified');
		}
	</script>
                        <div class="coinhive-captcha"
                             
		data-hashes="1024" 
		data-key="qSd2iWZ8oV25kTIbxTTtdXkNHXXHDM0U"
		data-whitelabel="true"
		data-disable-elements="input[type=button]"
		data-callback="myCaptchaCallback"
	>
		<em>Loading Captcha...<br></em>
	</div>-->
        <?php
        if (Configure::read('Users.RememberMe.active')) {
            echo $this->Form->control(Configure::read('Users.Key.Data.rememberMe'), [
                'type' => 'checkbox',
                'label' => __d('CakeDC/Users', 'Remember me'),
                'checked' => Configure::read('Users.RememberMe.checked')
            ]);
        }
        ?>

      </div>
      <div class="button-container">
          <?php
         //echo $this->Form->submit('Login', array('type' => 'button', 'id' => 'loginid', 'onClick' => 'validate(); return false;', 'class' => 'btn btn-primary', 'style' => 'width:35%'));
         ?>
       <?= $this->Form->button(__d('CakeDC/Users', 'Login')); ?>
      </div>
      <div class="footer">
           <?php
       if (Configure::read('Users.Email.required')) {
            
            echo $this->Html->link(__d('CakeDC/Users', 'Forgot your password?'), ['action' => 'requestResetPassword']);
        }
        ?>
          <?= implode(' ', $this->User->socialLoginList()); ?>
      </div>
    
    <?= $this->Form->end() ?>
  </div>
</div>

