$(document).ready(function() {
    $("#login-frm").submit(function(e) {
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();
        var valid = new validation();
        if (valid.is_username(username)) {
            if (valid.is_password(password)) {
                $.ajax({
                    url: "managers/login_mgr.php",
                    type: "POST",
                    datdaType:"json",
                    data: "login=true&u="+username+"&p="+password,
                    timeout: function() {
                        alert("error : Check your internet connection");
                    },
                    error: function() {
                        alert("error : Please try again later!");
                    },
                    success: function(data) {
                        if (data == "SUCCESS") {
                            window.location = 'home.php';
                        }else{
                            alert(data);
                        }
                    }
                });
            } else {
                //Custom MessageBox
            }
        } else {
            //Custom Messagebox
        }
    });
    $("#signup-frm").submit(function(e) {
        alert("Hello");
        e.preventDefault();
        var username = $("#reg_username").val().tirm();
        var password = $("#reg_password").val();
        var f_name = $("#f_name").val();
        var l_name = $("#l_name").val();
        var gender = $("#reg_gender").val();
        var dob = $("#reg_dob").val();
        // var year = $("#reg_year").val();
        // var month = $("#reg_month").val();
        // var day = $("#reg_day").val();
        var valid = new validation();
        if(empty(username)==true || empty(password)==true || empty(f_name)==true || empty(l_name)==true || empty(gender)==true || empty(dob)==true) {
                $('.error').slideDown(300);
                $('.error-msg').text(" ");
                $('.error-msg').text("Please correct your form data and try again!");
        }else{
            if (valid.is_username(username)) {
                if (valid.is_password(password)) {
                    if (valid.is_f_name(f_name)) {
                        if (valid.is_l_name(l_name)) {
                            if (valid.is_gender(gender)) {
                                if (valid.is_year(year)) {
                                    if (valid.is_month(month)) {
                                        if (valid.is_day(day)) {
                                            $.ajax({
                                                url: "managers/signup_mgr.php",
                                                type: "POST",
                                                datdaType: "json",
                                                data: "signup=true&u=" + username + "&p=" + password + "&f_name=" + f_name + "&l_name=" + l_name + "&gender=" + gender + "&year=" + year + "&month=" + month + "&day=" + day,
                                                timeout: function () {
                                                    alert("error : Check your internet connection");
                                                },
                                                error: function () {
                                                    alert("error : Please try again later!");
                                                },
                                                success: function () {

                                                    window.location('success.php');
                                                }
                                            });
                                        } else {
                                            alert("Your birth date seems to be invalid!");
                                        }
                                    } else {
                                        alert("Your birth month seems to be invalid!");
                                    }
                                } else {
                                    alert("Your birth year seems to be invalid!");
                                }
                            } else {
                                alert("The gender can't be the information you entered!");
                            }
                        }
                    }
                } else {
                    alert("The password you entered is invalid. Try a password with alphabets and numbers. It would be better if you use the special characters as well!");
                }
            } else {
                alert("Sorry, the username you provided can't be accepted!");
            }
        }
    });
    $('#msg').click(function(){
        $('#msg-div').slideToggle(500);
        $('#notif-div').slideUp(500);
        $('#settings').slideUp(500);
    });
    $('#notif').click(function(){
        $('#notif-div').slideToggle(500);
        $('#msg-div').slideUp(500);
        $('#settings').slideUp(500);
    });
    $('#set').click(function(){
        $('#settings').slideToggle(500);
        $('#notif-div').slideUp(500);
        $('#msg-div').slideUp(500);
    });
    $('#file-upload').click(function(){
        $('#file-upload-div').slideToggle(500);
        $('#location-div').slideUp(500);
        $('#tag-div').slideUp(500);
        $('#feeling-div').slideUp(500);
        $('#privacy-div').slideUp(500);
    });
    $('#set-location').click(function(){
        $('#file-upload-div').slideUp(500);
        $('#location-div').slideToggle(500);
        $('#tag-div').slideUp(500);
        $('#feeling-div').slideUp(500);
        $('#privacy-div').slideUp(500);
    });
    $('#set-tag').click(function(){
        $('#file-upload-div').slideUp(500);
        $('#location-div').slideUp(500);
        $('#tag-div').slideToggle(500);
        $('#feeling-div').slideUp(500);
        $('#privacy-div').slideUp(500);
    });
    $('#set-feeling').click(function(){
        $('#feeling-div').slideToggle(500);
        $('#file-upload-div').slideUp(500);
        $('#location-div').slideUp(500);
        $('#tag-div').slideUp(500);
        $('#privacy-div').slideUp(500);
    });
    $('#set-privacy').click(function(){
        $('#feeling-div').slideUp(500);
        $('#file-upload-div').slideUp(500);
        $('#location-div').slideUp(500);
        $('#tag-div').slideUp(500);
        $('#privacy-div').slideToggle(500);
    });

});
function validation(){
    this.is_f_name = function(){
        return true;
    }
    this.is_l_name = function () {
        return true;
    }
    this.is_gender = function(){
        return true;
    }
    this.is_year = function(){
        return true;
    }
    this.is_month = function(){
        return true;
    }
    this.is_day = function(){
        return true;
    }
    this.is_birthday = function(){
        return true;
    }
    this.is_username= function(){
        return true;
    }
    this.is_username_available = function(){
        return true;
    }
    this.is_password = function(){
        return true;
    }
};



