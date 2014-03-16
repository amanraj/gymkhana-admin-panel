$(document).ready(function() {
    

    $("#add-user-form").on('submit', function(e){

        e.preventDefault(); //STOP default action
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data, textStatus, jqXHR) 
            {
                $("#add-user-msg").html(data);
                $("#add-user-msg").css("display","");
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                //if fails      
            }
        });
        
        //e.unbind(); //unbind. to stop multiple form submit.
    });

    $("#calendar-form").on('submit', function(e){

        e.preventDefault(); //STOP default action
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success:function(data, textStatus, jqXHR) 
            {
                $("#add-user-msg").html(data);
                $("#add-user-msg").css("display","");
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                //if fails      
            }
        });
        
        //e.unbind(); //unbind. to stop multiple form submit.
    });

    $("#view-users-btn").click(function(){
      $.get("add_users.php?view=y",function(data,status){
        //alert("Data: " + data + "\nStatus: " + status);
        $("#view-users-msg").html(data);
      });
    });

    $("#mom-form").on('submit', function(e){

        e.preventDefault(); //STOP default action
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data, textStatus, jqXHR) 
            {
                $("#add-mom-msg").html(data);
                $("#add-mom-msg").css("display","");
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                //if fails      
            }
        });
        
        //e.unbind(); //unbind. to stop multiple form submit.
    });


    $("#add-judge-form").on('submit', function(e){

        e.preventDefault(); //STOP default action
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data, textStatus, jqXHR) 
            {
                $("#add-judge-msg").html(data);
                $("#add-judge-msg").css("display","");
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                //if fails      
            }
        });
        
        //e.unbind(); //unbind. to stop multiple form submit.
    });

    $("#view-mom-form").on('submit', function(e){

        e.preventDefault(); //STOP default action
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
        {
            url : formURL,
            type: "GET",
            data : postData,
            success:function(data, textStatus, jqXHR) 
            {
                $("#view-mom-msg").html(data);
                $("#view-mom-msg").css("display","");
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                //if fails      
            }
        });
        
        //e.unbind(); //unbind. to stop multiple form submit.
    });

    /*$("#view-mom-btnZ").click(function(){
      $.get("mom.php?view=y",function(data,status){
        //alert("Data: " + data + "\nStatus: " + status);
        $("#view-mom-msg").html(data);
      });
    });*/


    $("#view-judge-form").on('submit', function(e){

        e.preventDefault(); //STOP default action
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
        {
            url : formURL,
            type: "GET",
            data : postData,
            success:function(data, textStatus, jqXHR) 
            {
                $("#view-judge-msg").html(data);
                $("#view-judge-msg").css("display","");
                
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                //if fails      
            }
        });
        
        //e.unbind(); //unbind. to stop multiple form submit.
    });

    $("#view-judge-final-form").on('submit', function(e){

        e.preventDefault(); //STOP default action
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
        {
            url : formURL,
            type: "GET",
            data : postData,
            success:function(data, textStatus, jqXHR) 
            {
                $("#view-judge-final-msg").html(data);
                $("#view-judge-final-msg").css("display","");
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                //if fails      
            }
        });
        
        //e.unbind(); //unbind. to stop multiple form submit.
    });
    


}); //document.ready   












function del_user(usr) {
    $.get("add_users.php?del="+usr,function(data,status){
      //alert("Data: " + data + "\nStatus: " + status);
      $("#del-user-msg").html(data);
      $("#del-user-msg").css("display","");
      $("#view-users-btn").click();
    });
}



function del_mom(mom_event, date) {
    $.get("mom.php?del=y&event="+encodeURIComponent(mom_event)+"&date="+encodeURIComponent(date),function(data,status){
      //alert("Data: " + data + "\nStatus: " + status);
      $("#del-mom-msg").html(data);
      $("#del-mom-msg").css("display","");
      
      $("#view-mom-form").submit();
    });
}

function del_judge(judge_event, judge) {
    $.get("judge.php?del=y&event="+encodeURIComponent(judge_event)+"&judge="+encodeURIComponent(judge),function(data,status){
      //alert("Data: " + data + "\nStatus: " + status);
      $("#del-judge-msg").html(data);
      $("#del-judge-msg").css("display","");
      
      $("#view-judge-form").submit();
    });
}

function del_judge_final(judge_event, judge) {
    $.get("judges_final.php?del=y&event="+encodeURIComponent(judge_event)+"&judge="+encodeURIComponent(judge),function(data,status){
      //alert("Data: " + data + "\nStatus: " + status);
      $("#del-judge-final-msg").html(data);
      $("#del-judge-final-msg").css("display","");
      $("#del-judge-msg").css("display","none");
      $("#view-judge-msg").css("display","none");
      $("#view-judge-final-form").submit();
    });
}

function remove_judge_final(judge_event, judge) {
    $.get("judges_final.php?del=y&event="+encodeURIComponent(judge_event)+"&judge="+encodeURIComponent(judge),function(data,status){
      //alert("Data: " + data + "\nStatus: " + status);
      $("#del-judge-msg").html(data);
      $("#del-judge-msg").css("display","");
      $("#del-judge-final-msg").css("display","none");
      $("#view-judge-final-msg").css("display","none");
      $("#view-judge-form").submit();
    });
}

function add_judge_final(judge_event, judge) {
    $.get("judges_final.php?add=y&event="+encodeURIComponent(judge_event)+"&judge="+encodeURIComponent(judge),function(data,status){
      //alert("Data: " + data + "\nStatus: " + status);
      $("#del-judge-msg").html(data);
      $("#del-judge-msg").css("display","");
      $("#del-judge-final-msg").css("display","none");
      $("#view-judge-final-msg").css("display","none");
      $("#view-judge-form").submit();

    });
}