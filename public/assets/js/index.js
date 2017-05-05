$(function() {
    $("#signin-btn").click(function(){

        $('#loginModal').modal({
            backdrop: 'static',
            keyboard: false
        })


    });


});

$(function() {
    $('.login').click(function () {
        var email = $('.email').val();
        var password = $('.password').val();

        if(email == 'parajuliminiyan@gmail.com' && password == "miniyan1"){
            $('.message').html("Login Successful");
        }else {
            $("#loginModal").effect('shake');
            $(".message").html('Email and Password didnot match!!');
        }

        
    })


});