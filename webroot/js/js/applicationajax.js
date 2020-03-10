function add(){
        //serialize form data 
        var formData = $('#newquestion').serialize(); 
        //get form action 
        var formUrl = $(this).attr('action'); 
        $.ajax({ 
            type: 'POST', 
            url: formUrl,
            data: formData, 
            success: function(status){                 
                    console.log('content='+status);  
            }, 
            error: function(xhr,textStatus,error){ 
                alert(error); 

        } });  

}