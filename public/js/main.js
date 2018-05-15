$(document).ready(function($){

    $("#phone_number")
        .mask("(99) 9999-9999?9")
        .focusout(function (event) {  
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            phone = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();  
            if(phone.length > 10) {  
                element.mask("(99) 99999-999?9");  
            } else {  
                element.mask("(99) 9999-9999?9");  
            }  
        });

    
    $('#delete_user').on('click', function(e){
        e.preventDefault();
        if(confirm('Certeza que deseja excluir a conta junto com seus contatos?')){
            location.href = "/delete";
        }
    });

    $('.del-contact').on('click', function(e){
        e.preventDefault();
        var url = $(this).data('href');
        var name = $(this).data('name');

        if(confirm('Certeza que deseja excluir o contato '+ name)){
            location.href = url;
        }
    });
});