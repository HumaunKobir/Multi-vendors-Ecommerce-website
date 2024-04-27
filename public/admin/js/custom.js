$(document).ready(function(){
    //call Data Table
    $("#section").DataTable();
    $("#ratings").DataTable();
    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");
    //Check Admin Pasword is correct or not
    $("#current_password").keyup(function(){
        var current_password= $("#current_password").val();
        // alert(current_password);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/check-current-password',
            data:{current_password:current_password},
            success:function(resp){
                if(resp=="true"){
                    $("#check_password").html("<font color='green'>Current Password is Incorrect!</font>");
                }else if(resp=="false"){
                        $("#check_password").html("<font color='red'>Current Password is Correct</font>");
                }
               

            },error:function(){
                alert('Error');
            }
        });
    })
    //Update Admin Status
    $(document).on("click",".updateAdminStatus",function(){
        var status = $(this).children("i").attr("status");
        var admin_id = $(this).attr("admin_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-admin-status',
            data:{status:status,admin_id:admin_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#admin-"+admin_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-outline'status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#admin-"+admin_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-check'status='Active'></i>");
                }
            },error:function(){
                alert("Error");
            }
        })
    })
    //update Section Status
    $(document).on("click",".updateSectionStatus",function(){
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-section-status',
            data:{status:status,section_id:section_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#section-"+section_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-outline'status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#section-"+section_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-check'status='Active'></i>");
                }
            },error:function(){
                alert("Error");
            }
        });
    })
    //Update Category Status
    $(document).on("click",".updateCategoryStatus",function(){
        var status = $(this).children("i").attr("status");
        var category_id = $(this).attr("category_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-category-status',
            data:{status:status,category_id:category_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#category-"+category_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-outline'status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#category-"+category_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-check'status='Active'></i>");
                }
            },error:function(){
                alert("Error");
            }
        });
    })
    //update Brand Status
    $(document).on("click",".updateBrandStatus",function(){
        var status = $(this).children("i").attr("status");
        var brand_id = $(this).attr("brand_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-brand-status',
            data:{status:status,brand_id:brand_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#brand-"+brand_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-outline'status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#brand-"+brand_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-check'status='Active'></i>");
                }
            },error:function(){
                alert("Error");
            }
        });
    })
    //update Rating Status
    $(document).on("click",".updateRatingStatus",function(){
        var status = $(this).children("i").attr("status");
        var rating_id = $(this).attr("rating_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-rating-status',
            data:{status:status,rating_id:rating_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#rating-"+rating_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-outline'status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#rating-"+rating_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-check'status='Active'></i>");
                }
            },error:function(){
                alert("Error");
            }
        });
    })
    //update Filter Status
    $(document).on("click",".updateFilterStatus",function(){
        var status = $(this).children("i").attr("status");
        var filter_id = $(this).attr("filter_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-filter-status',
            data:{status:status,filter_id:filter_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#filter-"+filter_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-outline'status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#filter-"+filter_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-check'status='Active'></i>");
                }
            },error:function(){
                alert("Error");
            }
        });
    })
    //update Filter Value Status
    $(document).on("click",".updateFiltersValueStatus",function(){
        var status = $(this).children("i").attr("status");
        var filter_value_id = $(this).attr("filter_value_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-filter-value-status',
            data:{status:status,filter_value_id:filter_value_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#filter_value-"+filter_value_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-outline'status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#filter_value-"+filter_value_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-check'status='Active'></i>");
                }
            },error:function(){
                alert("Error");
            }
        });
    })
        //Update Products Status
        $(document).on("click",".updateProductStatus",function(){
            var status = $(this).children("i").attr("status");
            var product_id = $(this).attr("product_id");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'post',
                url:'/admin/update-product-status',
                data:{status:status,product_id:product_id},
                success:function(resp){
                    if(resp['status']==0){
                        $("#product-"+product_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-outline'status='Inactive'></i>");
                    }else if(resp['status']==1){
                        $("#product-"+product_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-check'status='Active'></i>");
                    }
                },error:function(){
                    alert("Error");
                }
            });
        })

    //Custom Deletiion
    $(document).on("click",".confirmDelete",function(){
        var module = $(this).attr('module');
        var moduleid = $(this).attr('moduleid');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
              });
              window.location = "/admin/delete-"+module+"/"+moduleid;
            }
          });
    })
    //Append Categories Lavel
    $("#section_id").change(function(){
        var section_id = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'get',
            url:'/admin/append-categories-lavel',
            data:{section_id:section_id},
            success:function(resp){
                $("#appendCategoriesLavel").html(resp);
            },error:function(){
                alert("error");
            }
        })
    });
    //Add Remove Fields
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div style="height:10px;"></div><input type="text" name="size[]" placeholder="Size" value=""/>&nbsp;<input type="text" name="sku[]" placeholder="SkU" value=""/>&nbsp;<input type="text" name="price[]" placeholder="Price" value=""/>&nbsp;<input type="text" name="stock[]" placeholder="Stock" value=""/>&nbsp;<a href="javascript:void(0);" class="remove_button"><i style="font-size:25px;" class="mdi mdi-minus-box"></i></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increase field counter
            $(wrapper).append(fieldHTML); //Add field html
        }else{
            alert('A maximum of '+maxField+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
    //Show filters on selection of category
    $("#category_id").on('change',function(){
        var category_id = $(this).val();
        //alert(category_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'category-filters',
            data:{category_id:category_id},
            success:function(resp){
                $(".loadFilters").html(resp.view);
            }
        });
    });
    //Update Atrribute Status
    $(document).on("click",".updateAttributeStatus",function(){
        var status = $(this).children("i").attr("status");
        var attribute_id = $(this).attr("attribute_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-attribute-status',
            data:{status:status,attribute_id:attribute_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#attribute-"+attribute_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-outline'status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#attribute-"+attribute_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-check'status='Active'></i>");
                }
            },error:function(){
                alert("Error");
            }
        });
    })
    //Update Image Status
    $(document).on("click",".updateImageStatus",function(){
        var status = $(this).children("i").attr("status");
        var image_id = $(this).attr("image_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-image-status',
            data:{status:status,image_id:image_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#image-"+image_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-outline'status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#image-"+image_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-check'status='Active'></i>");
                }
            },error:function(){
                alert("Error");
            }
        });
    })
     //Update Banner Status
     $(document).on("click",".updateBannerStatus",function(){
        var status = $(this).children("i").attr("status");
        var banner_id = $(this).attr("banner_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-banner-status',
            data:{status:status,banner_id:banner_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#banner-"+banner_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-outline'status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#banner-"+banner_id).html("<i style='font-size:25px;' class='mdi mdi-bookmark-check'status='Active'></i>");
                }
            },error:function(){
                alert("Error");
            }
        });
    }) 

});
