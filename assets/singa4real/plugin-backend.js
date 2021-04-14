$(document).on("submit", ".installbackendapp", function(event)
{
 $(".ajaxbtn").attr("disabled", true);   
    event.preventDefault();
var frm = $(this);
    $.ajax({
        type: 'POST',
        url:  './assets/singa4real/pro.php',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data, status)
        {
		 var res = JSON.parse(data);
		 if(res.status == "OK"){
		  $(".report").html("<div class='bg-success text-white p-2'>"+res.info+"</div>");
		  $(".ajaxbtn").hide();
		  $(".fdiv").hide();
		  $(".inbtn").show();
		  $(".ajaxbtn").attr("disabled", false);
		  }else{
		  $(".report").html("<div class='bg-danger text-white p-2'>"+res.info+"</div>");
		  $(".ajaxbtn").attr("disabled", false);
		  }
        },
        error: function (xhr, desc, err)
        {
        $(".ajaxbtn").attr("disabled", false);
        $(".report").html(desc);
        }
    });
});		