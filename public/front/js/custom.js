
$(document).ready(function(){
    $("#getPrice").change(function(){
        var size = $(this).val();
        var product_id = $(this).attr("product-id");
        //alert(size);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/get-product-price',
            type:"post",
            data:{size:size,product_id:product_id},
            success:function(resp){
                //alert(resp['final_price']);
                if(resp['discount'] >0){
                    $(".getAttributePrice").html("<div class='price-box pt-20'><span class='new-price new-price-2'>"+resp['final_price']+" tk</span></div><div class='price-box pt-20'><span>Original Price : </span><span class='old-price'>"+resp['product_price']+" tk</span></div>");
                }else{
                   
                    $(".getAttributePrice").html("<div class='price-box pt-20'><span class='new-price new-price-2'>"+resp['final_price']+" tk</span></div>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
  
    //Register Form Validation for User
    $("#registerForm").submit(function(){
        var formdata = $(this).serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/user/register',
            type:"post",
            data:formdata,
            success:function(resp){
                if(resp.type=="error"){
                    $.each(resp.errors,function(i,error){
                        $("#register-"+i).attr('style','color:red');
                        $("#register-"+i).html(error);
                        setTimeout(function(){
                            $("#register-"+i).css({'display':'none'});
                        },3000);
                    });
                }else if(resp.type=="success"){
                    window.location.href = resp.url;
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Login Form Validation for User
    $("#loginForm").submit(function(){
        var formdata = $(this).serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/user/login',
            type:"post",
            data:formdata,
            success:function(resp){
                if(resp.type=="error"){
                    $.each(resp.errors,function(i,error){
                        $("#login-"+i).attr('style','color:red');
                        $("#login-"+i).html(error);
                        setTimeout(function(){
                            $("#login-"+i).css({'display':'none'});
                        },3000);
                    });
                }else if(resp.type=="incorrect"){
                    $("#login-error").attr('style','color:red');
                    $("#login-error").html(resp.message);
                    setTimeout(function(){
                        $("#login-error").css({'display':'none'});
                    },3000);
                }else if(resp.type=="success"){
                    $("#register-success").attr('style','color:green');
                    $("#register-success").html(resp.message);
                    window.location.href = resp.url;
                }else if(resp.type=="inactive"){
                    $("#login-error").attr('style','color:red');
                    $("#login-error").html(resp.message);
                    setTimeout(function(){
                        $("#login-error").css({'display':'none'});
                    });
                }
            },error:function(){
                alert("Error");
            }
        });
    });

});


//Push The array value 
function get_filter(class_name){
    var filter = [];
    $('.'+class_name+':checked').each(function(){
        filter.push($(this).val());
    });
    return filter;
}