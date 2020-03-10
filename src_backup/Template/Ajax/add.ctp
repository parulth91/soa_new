<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Volunteer $volunteer
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?= $this->Form->create($volunteer); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Volunteer']) ?></legend>
    <?php
    ?><div class=col-md-6><?php
    echo $this->Form->control('name');
    ?></div><?php
    ?><div class=col-md-6><?php
    echo $this->Form->control('email');
    ?></div><?php
    ?><div class=col-md-6><?php
    echo $this->Form->control('phone_no');
    ?></div><?php
    ?><div class=col-md-6><?php
    echo $this->Form->control('ms_country_id', ['options' => $msCountries]);
    ?></div><?php
    ?><div class=col-md-6><?php
    echo $this->Form->control('ms_state_id', ['options' => $msStates]);
    ?></div><?php
    ?><div class=col-md-6><?php
    echo $this->Form->control('ms_district_id', ['options' => $msDistricts]);
    ?></div><?php
    ?><div class=col-md-6><?php
    echo $this->Form->control('contacted_status');
    ?></div><?php
    ?><div class=col-md-6><?php
    echo $this->Form->control('contacted_remarks');
    ?></div><?php
    ?><div class=col-md-6><?php
    echo $this->Form->control('contribution_type_id', ['options' => $contributionTypes]);
    ?></div><?php
    ?><div class=col-md-6><?php
    echo $this->Form->control('availability_id', ['options' => $availability]);
    ?></div><?php
    ?><div class=col-md-6><?php
    echo $this->Form->control('is_active');
    ?></div><?php
    ?><div class=col-md-6><?php
        echo $this->Form->control('action_date');
        ?></div><?php
        ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>

<script type="text/javascript">

    $('#ms-country-id').on('change', function () {
        var permnt_state_id = $('#ms-state-id').val();
        var permnt_district_id = $('#ms-district-id').val();
        if (permnt_district_id = "" || permnt_district_id == null) {
            permnt_district_id = "";
        }

        var ms_country_id = $('#ms-country-id').val();
        $.ajax({
            type: "GET",
            url: "<?php echo $this->Url->build(array('controller' => 'Ajax', 'action' => 'findStateToCountry')); ?>",
            data: {ms_country_id: ms_country_id},
            success: function (data) {
                if (data != 0) {
                    var exploded_data = data.split("@");
                    $('#ms-state-id').html(exploded_data[0]);
                    $('#ms-district-id').html(exploded_data[1]);

                } else {
                    alert('No Record Found....!!!');
                    $('#ms-state-id').html('<option value="">Select State</option>');
                    $('#ms-district-id').html('<option value="">Select District</option>');

                }
            }
        });

    });
    $('#ms-state-id').on('change', function () {
        var ms_state_id = $('#ms-state-id').val();
        var ms_district_id = $('#ms-district-id').val();
        if (ms_district_id = "" || ms_district_id == null) {
            ms_district_id = "";
        }

        $.ajax({
            type: "GET",
            // cache: false,
            url: "<?php echo $this->Url->build(array('controller' => 'Ajax', 'action' => 'findDistrictToState')); ?>",
            data: {ms_state_id: ms_state_id},
            success: function (data) {
                //   alert(data);
                if (data != 0) {
                    $('#ms-district-id').html(data);
                } else {
                    alert('No Record Found....!!!');
                    $('#ms-district-id').html('<option value="">Select District</option>');

                }
            }
        });
    });
</script>

