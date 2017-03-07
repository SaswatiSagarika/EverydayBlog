/**
*File name: CreateCommentAjax.
*File type: js.
*Date of  creation:1st march 2017.
*Author:mindfire solutions(saswati).
*Purpose: this page contain javascript for read php page.
*Path:D:\Projects\hello-world\demo\js.
**/

/**
* helps in creatin new comment to the blog.
* @param TOKEN CSRF_TOKEN.
* @param string string_object.
* @param integer i.
* @filesource read.blade.php.
**/
$(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        $("#postbutton").on('click',function(e){
           
            e.preventDefault();
            $.blockUI({ message: '<h1> Just a moment...</h1>' });
            $.ajax({
                url: '/createcomment/Commentrecord',
                type: 'post',
                data: {_token: CSRF_TOKEN,id:$("#id").val(), name:$("#name").val(),
                email:$("#email").val(),comment:$("#comment").val()},
                dataType: 'JSON',
                success: function (response) {
                    console.log(response);
                                       
                    var comment ='<p>'+response.CommenterMessage+'</p><p><i> by </i> '+response.CommenterName+ '<i> on </i>'+response.CommentDate +'  <i> at </i>'+ response.CommentTime+'</p><p>'+response.CommenterEmail+'</p><hr>';
                        
                        $(".comment-list").prepend(comment);
                        
                        $.unblockUI();
                      $('#myform').trigger("reset");  
                }
                
            })
        });
    });
    