
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
    // Update Cart Items
    $(document).on('click','.updateCartItem',function(){
        alert("test");
    });
    // Delete Cart Items
    $(document).on('click','.deleteCartItem',function(){
        var cartid = $(this).data('cartid');
        var result = confirm("Are You Sure Delete Cart Items?");
        if(result){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:'/cart/delete',
                data:{cartid:cartid},
                type:"post",
                success:function(resp){
                    $(".totalCartItems").html(resp.totalCartitems);
                    $("#appendCartItems").html(resp.view);
                    $("#appendHeaderCartItems").html(resp.headerview);
                },error:function(){
                    alert("Error");
                }
            });
        }
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
                        },9000);
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
                        },9000);
                    });
                }else if(resp.type=="incorrect"){
                    $("#login-error").attr('style','color:red');
                    $("#login-error").html(resp.message);
                    setTimeout(function(){
                        $("#login-error").css({'display':'none'});
                    },9000);
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
    //Forgot Password Form Validation for User
    $("#forgotForm").submit(function(){
        var formdata = $(this).serialize();
        $.ajax({
            url:'/user/forgot-password',
            type:"POST",
            data:formdata,
            success:function(resp){
                if(resp.type=="error"){
                    $.each(resp.errors,function(i,error){
                        $("#forgot-"+i).attr('style','color:red');
                        $("#forgot-"+i).html(error);
                        setTimeout(function(){
                            $("#forgot-"+i).css({'display':'none'});
                        },3000);
                    });
                }else if(resp.type=="success"){
                    $("#forgot-success").attr('style','color:green');
                    $("#forgot-success").html(resp.message);
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Upddate account Form Validation for User
    $("#accountForm").submit(function(){
        var formdata = $(this).serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/user/account',
            type:"post",
            data:formdata,
            success:function(resp){
                if(resp.type=="error"){
                    $.each(resp.errors,function(i,error){
                        $("#account-"+i).attr('style','color:red');
                        $("#account-"+i).html(error);
                        setTimeout(function(){
                            $("#account-"+i).css({'display':'none'});
                        },9000);
                    });
                }else if(resp.type=="success"){
                    $("#account-success").attr('style','color:green');
                    $("#account-success").html(resp.message);
                    setTimeout(function(){
                        $("#account-success").css({'display':'none'});
                    },9000);
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Upddate account password Form Validation for User
    $("#passwordForm").submit(function(){
        //alert("test");
        var formdata = $(this).serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/user/update-password',
            type:"post",
            data:formdata,
            success:function(resp){
                if(resp.type=="error"){
                    $.each(resp.errors,function(i,error){
                        $("#password-"+i).attr('style','color:red');
                        $("#password-"+i).html(error);
                        setTimeout(function(){
                            $("#password-"+i).css({'display':'none'});
                        },6000);
                    });
                }else if(resp.type=="success"){
                    $("#password-success").attr('style','color:green');
                    $("#password-success").html(resp.message);
                    setTimeout(function(){
                        $("#password-success").css({'display':'none'});
                    },6000);
                }else if(resp.type=="incorrect"){
                    $("#password-error").attr('style','color:red');
                    $("#password-error").html(resp.message);
                    setTimeout(function(){
                        $("#password-error").css({'display':'none'});
                    });
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Add Edit Delivery Address 
    $(document).on('click','.editAddress',function(){
        var addressid = $(this).data('addressid');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{addressid:addressid},
            url:'/get-delivery-address',
            type:'post',
            success:function(resp){
                //$("#showdifferent").removeclass("collapse");
                $('[name=delivery_country]').val(resp.address['country']);
                $('[name=delivery_id]').val(resp.address['id']);
                $('[name=delivery_name]').val(resp.address['name']);
                $('[name=delivery_address]').val(resp.address['address']);
                $('[name=delivery_city]').val(resp.address['city']);
                $('[name=delivery_state]').val(resp.address['state']);
                $('[name=delivery_pincode]').val(resp.address['pincode']);
                $('[name=delivery_mobile]').val(resp.address['mobile']);
            },error:function(){
                alert("Error");
            }
        });
    });
    //Save Delivery Address
    $(document).on('submit','#addressAddEditForm',function(){
        var formdata = $('#addressAddEditForm').serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/save-delivery-address',
            type:"post",
            data:formdata,
            success:function(resp){
                if(resp.type=="error"){
                    $.each(resp.errors,function(i,error){
                        $("#delivery-"+i).attr('style','color:red');
                        $("#delivery-"+i).html(error);
                        setTimeout(function(){
                            $("#delivery-"+i).css({'display':'none'});
                        },3000);
                    });
                }else{
                    $("#deliveryAddresses").html(resp.view);
                    window.location.href = "checkout";
                }
            },error:function(){
                alert("Error");
            }
        });
    });
     //Remove Delivery Address
     $(document).on('click','.removeAddress',function(){
        if(confirm('Are Your Sure Remove This?')){
            var addressid = $(this).data('addressid');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:'/remove-delivery-address',
                type:'post',
                data:{addressid:addressid},
                success:function(resp){
                    $("#deliveryAddresses").html(resp.view);
                    window.location.href = "checkout";
                },error:function(){
                    alert("Error");
                }
            })
        }
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