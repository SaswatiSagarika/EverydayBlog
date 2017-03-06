    var url = "http://localhost:8080/blog/public/productajaxCRUD";
    //display modal form for product editing
    $(document).on('click','.open_modal',function(){
        var id = $(this).val();
       
        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#id').val(data.id);
            $('#name').val(data.name);
             $('#email').val(data.email);
            $('#content').val(data.content);
            $('#btn-save').val("update");
        }) 
    });
    //display modal form for creating new product
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#frmProducts').trigger("reset");
        $('#myModal').modal('show');
    });

    //create new product / update existing product
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            name: $('#name').val(),
            email:$('#email').val(),
            content: $('#content').val(),
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var product_id = $('#id').val();;
        var my_url = url;
        
        console.log(formData);
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var comment = '<tr id="product' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email +'</td><td>' + data.content + '</td>';
                if (state == "add"){ //if user added a new record
                    $('#comment-list').append(comment);
                }else{ //if user updated an existing record
                    $("#comment" + product_id).replaceWith( comment );
                }
                $('#myform').trigger("reset");
                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });