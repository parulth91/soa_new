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
        <td><?php echo $user->last_name;  ?></td>
        <td><strong>Date of Birth</td>
        
        <td><?php
        if($user->dob == NULL)
        {
        echo "-";    
        }else{
         echo date_format($user->dob, "d-m-Y");   
        } ?></td>
        
      </tr>
      
      <tr>
        <td><strong>Username</td>
        <td><?php echo $user->username; ?></td>
        <td><strong>Email</td>
        <td><?php echo $user->email;  ?></td>
        <td><strong>Date of Activation</td>
        <td><?php
        if($user->activation_date == NULL)
        {
            
        }else{
         echo date_format($user->activation_date, "d-m-Y");   
        } ?></td>
        
      </tr>
      <tr>
        <td><strong>Role</td>
        <td><?php echo $user->role; ?></td>
        <td><strong>Phone No</td>
        <td><?php echo $user->phone_no;  ?></td>
        <td><strong>Regimental Number</td>
        <td><?php echo $user->regimental_number; ?></td>
      </tr>
            
    </tbody>
    
  </table>
    <div class=col-md-6><?php
    echo $this->Form->control('active');
    ?></div>
    
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
