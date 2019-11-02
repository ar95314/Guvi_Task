$(document).ready(function(){
    $('#signup').click(function(){
        var email = $('#inputEmail').val();
        var password = $('#inputPassword').val();
        $.post("../controller/signup.php",{email:email,password:password},function(data,status){
            console.log(data);

            if(data.status == '1'){
                alert("Successfully Signed Up !!\nRedirecting You to Login Page...");
                setTimeout(function(){
                    window.location.href = '../index.html';
                },1500);
            }
            else{
                alert("Error While Signup");
            }
        });
    });
});