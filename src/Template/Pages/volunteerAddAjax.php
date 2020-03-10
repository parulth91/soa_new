
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






<!--edit of sttates and countries-->
<script type="text/javascript">

    $(document).ready(function () {
        var ms_country_id = $('#ms-country-id').val();
        var ms_state_id = $('#ms-state-id').val();
        var ms_district_id = $('#ms-district-id').val();

        $.ajax({
            type: "GET",
            url: "<?php echo $this->Url->build(array('controller' => 'Ajax', 'action' => 'findStateToCountry')); ?>",
            data: {ms_country_id: ms_country_id, ms_state_id: ms_state_id},
            success: function (data) {

                if (data != 0) {
                    var ms_country_id = $('#ms-country-id').val();
                    var ms_district_id = $('#ms-district-id').val();

                    var exploded_data = data.split("@");
                    $('#ms-state-id').html(exploded_data[0]);

                    $.ajax({
                        type: "GET",
                        url: "<?php echo $this->Url->build(array('controller' => 'Ajax', 'action' => 'findDistrictToState')); ?>",
                        data: {ms_district_id: ms_district_id, ms_state_id: ms_state_id},
                        success: function (data) {
                           // alert(data);
                            if (data != 0) {

                                $('#ms-district-id').html(data);


                            } else {

                                $('#ms-district-id').html('<option value="">Select District</option>');

                            }
                        }
                    });

                } else {
                    $('#ms_state_id').html('<option value="">Select State</option>');
                    $('#ms_district_id').html('<option value="">Select District</option>');
                }
            }
        });

    });



    $('#ms-country-id').on('change', function () {

        var ms_country_id = $('#ms-country-id').val();
        var ms_state_id = $('#ms-state-id').val();
        $.ajax({
            type: "GET",
            url: "<?php echo $this->Url->build(array('controller' => 'Ajax', 'action' => 'findStateToCountry')); ?>",
            data: {ms_country_id: ms_country_id, ms_state_id},
            success: function (data) {
                //alert("data");
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
                   // alert('No Record Found....!!!');
                    $('#ms-district-id').html('<option value="">Select District</option>');

                }
            }
        });
    });

</script>