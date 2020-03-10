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
    <legend><?= __('Edit {0}', ['User']) ?></legend>

    <table class="table table-bordered current_postings_table" cellpadding="0" cellspacing="0">
        <thead>

        </thead>
        <tbody>
            <tr>
                <td><strong>Firstname</td>
                <td><?php echo $user->first_name; ?></td>
                <td><strong>Lastname</td>
                <td><?php echo $user->last_name; ?></td>
                <td><strong>Date of Birth</td>

                <td><?php
                    if ($user->dob == NULL) {
                        echo "-";
                    } else {

                        echo $this->Form->input('dob', ['label' => false,
                            'id' => 'dob',
                            'value' => date_format($user->dob, "d-m-Y"),
                            //'readonly' => 'true',
                            'type' => 'text',
                            'maxlength' => 10,
                            'oninput' => "setCustomValidity('')",
                            'placeholder' => "dd-mm-yyyy", "onkeyup" => "return validateDate(this);",
                            'required' => 'true',
                            'autocomplete' => "off",
                        ]);
                    }
                    ?></td>

            </tr>

            <tr>
                <td><strong>Username</td>
                <td><?php echo $user->username; ?></td>
                <td><strong>Email</td>
<!--                <td><?php //echo $user->email;  ?></td>-->
                <td><?php
                    echo $this->Form->input('email', ['label' => false,
                        'id' => 'email',
                        'maxlength' => "20",
                        'minlength' => "20",
                        //'onkeypress' => "return (alphachar(event, numeric));",
                        'required' => 'true',
                        'autocomplete' => "off"
                    ]);
                    ?></td>
                <td><strong>Date of Activation</td>
                <td><?php
                    if ($user->activation_date == NULL) {
                        
                    } else {
                        echo date_format($user->activation_date, "d-m-Y");
                    }
                    ?></td>

            </tr>
            <tr>
                <td><strong>Role</td>

                <td>
                    <?php
                    if ($user->activation_date != NULL) {
                        echo $user->role;
                    } else {
                     /*   $options = ['deoUnit' => 'DEO Unit', 'soUnit' => 'SO Unit', 'mainUnit' => 'Unit Head', 'esttUser' => 'HQ Estt User'];*/
                     $options = ['stateSecretary' => 'State Secretary']; 
                        echo $this->Form->control('role', [
                        'type' => 'select',
                        'empty' => 'select',
                        'options' => $options,
                        'label' => false, 'placeholder' => 'Select Role', 'required' => true]);
                         
                    }
                    ?>
                </td>
                <td><strong>Phone No</td>
                <td><?php
                    echo $this->Form->input('phone_no', ['label' => false,
                        'id' => 'phone_no',
                        'type' => 'numeric',
                        'maxlength' => "10",
                        'minlength' => "10",
                        'onkeypress' => "return (alphachar(event, numeric));",
                        'required' => 'true',
                        'autocomplete' => "off"
                    ]);
                    ?></td>
  <!--               <td><strong>Regimental Number</td>
               <td><?php
                    //echo $this->Form->input('regimental_number', ['label' => false,
                       // 'id' => 'regimental_number',
                       // 'type' => 'numeric',
                     //   'maxlength' => "9",
                     //   'minlength' => "9",
                     //   'onkeypress' => "return (alphachar(event, numeric));",
                     //   'required' => 'true',
                     //   'autocomplete' => "off"
                  //  ]);
                    ?></td>-->
            </tr>

        </tbody>

    </table>
    <div class=col-md-6><?php
                    echo $this->Form->control('active');
                    ?></div>

</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
<script type="text/javascript">
    function validateDate(date) {
        var v = date.value;
        if (v.match(/^\d{2}$/) !== null) {
            date.value = v + '-';
        } else if (v.match(/^\d{2}\-\d{2}$/) !== null) {
            date.value = v + '-';
        }
    }

    var d = new Date();
    var year = d.getFullYear() - 18;
    d.setFullYear(year);


    $("#dob").datepicker({
        dateFormat: 'dd-mm-yy',
        autoPick: false,
        changeMonth: true,
        changeYear: true,
        defaultDate: d,
        maxYear: d,
        maxDate: new Date(2019, 5, 30),
        yearRange: "c-60:c+19"
    });
</script>