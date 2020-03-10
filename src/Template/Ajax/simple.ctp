<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<script type="text/javascript">
$(function() 
{
    $('#button').click(function() 
    {
        var targeturl = $(this).attr('rel');
        $.ajax({
            type: 'get',
            url: targeturl,
            beforeSend: function(xhr) 
            {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function(response) 
            {
                if (response.result) 
                {
                    var result = response.result;
                    $('#result').html(result.now);
                }
            },
            error: function(e) 
            {
                alert("An error occurred: " + e.responseText.message);
                console.log(e);
            }
        });
    });
});
</script>

<div class="index large-9 medium-8 columns content">
    <h2>Simple JSON Response</h2>

    <p>
    In this simple example we request something via JSON GET request.
    The response will be an object and its content is accessable via `response.result`. The result itself can contain multiple data keys.
    We just need our `result.now` date value.
    </p>

    <?php 
    $request = $this->Url->build(['controller' => 'ajax', 'action' => 'dropdownAction', 'ext' => 'json']);
    ?>
    <button id="button" rel="<?= $request ?>">Click me</button>

    <h3>Resultado</h3>
    <div id="result">
        <i>n/a</i>
    </div>

</div>