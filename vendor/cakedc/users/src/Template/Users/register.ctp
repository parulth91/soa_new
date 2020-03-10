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
    echo $this->Html->link(__d('CakeDC/Users', 'Already Signed Up User Login Here!'), ['action' => 'login']);
    ?></div>
<div class="container">
    <div class="card alt"></div>
    <div class="card">
        <h1 class="title">Sign Up</h1>
        <?= $this->Form->create($user); ?>
        <fieldset>
            <legend><?= __d('CakeDC/Users', '') ?></legend>

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

                <?php
                echo $this->Form->input('dob', ['label' => false,
                    'id' => 'date_of_birth',
                    //'readonly' => 'true',
                    'type' => 'text',
                    'maxlength' => 10,
                    "readonly" => "readonly",
                    'oninput' => "setCustomValidity('')",
                    'placeholder' => "DOB in yy-mm-dd", "onkeyup" => "return validateDate(this);",
                    'required' => 'true',
                    'autocomplete' => "off",
                ]);
                ?>

                <div class="bar"></div>
            </div>

            <div class="input-container">
                <?= $this->Form->control('username', ['label' => false, 'placeholder' => 'Username', 'required' => true]) ?>
                <div class="bar"></div>
                <?=
                $this->Form->control('email', ['label' => false,
                    'placeholder' => 'Email', 'required' => true])
                ?>
            </div>
            <div class="input-container">
                <?php
//                $this->Form->control('regimental_number', [
//                    'label' => false, 'placeholder' => 'Regimental Number',
//                    'type' => 'numeric',
//                    'maxlength' => "9",
//                    'minlength' => "9",
//                    'onkeypress' => "return (alphachar(event, numeric));",
//                    'required' => 'true',
//                    'autocomplete' => "off"
//                ])
                ?>
                <?=
                $this->Form->control('phone_no', [
                    'label' => false, 'placeholder' => 'Phone No',
                    'type' => 'numeric',
                    'maxlength' => "10",
                    'minlength' => "10",
                    'onkeypress' => "return (alphachar(event, numeric));",
                    'required' => 'true',
                    'autocomplete' => "off"
                ])
                ?>
                <div class="bar"></div>
            </div>
            <div class="input-container">
                Role of User
                <?php $options = ['stateSecretary' => 'State Secretary']; ?>
                <?=
                $this->Form->control('role', [
                    'type' => 'select',
                    'empty' => 'select',
                    'options' => $options,
                    'label' => false, 'placeholder' => 'Select Role', 'required' => true])
                ?>
                <div class="bar"></div>
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

<SCRIPT language="javascript">

    var d = new Date();
    var year = d.getFullYear() - 18;
    d.setFullYear(year);


    $("#date_of_birth").datepicker({
        dateFormat: 'yy-mm-dd',
        autoPick: false,
        changeMonth: true,
        changeYear: true,
        defaultDate: d,
        maxYear: d,
        maxDate: new Date(2019, 5, 30),
        yearRange: "c-60:c+19"
    });
</script>