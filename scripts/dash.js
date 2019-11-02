$(document).ready(function(){
    $.post("../controller/dash.php",function(data,status){
        console.log(data)
        if(data.status=='1'){
            if(data.user.email){
                $('#email').val(data.user.email);
            }
            if(data.user.name){
                $('#name').val(data.user.name);
            }
            if(data.user.address){
                $('#address').val(data.user.address);
            }
            if(data.user.country){
                $('#country').val(data.user.country);
            }
            if(data.user.city){
                $('#city').val(data.user.city);
            }
            if(data.user.state){
                $('#state').val(data.user.state);
            }
            if(data.user.phone){
                $('#phone').val(data.user.phone);
            }
            if(data.user.age){
                $('#age').val(data.user.age);
            }

        } else{
            window.location.href='../index.html';
        }
    });

    $('#update').click(function(){
        var name = $('#name').val();
        var city = $('#city').val();
        var country = $('#country').val();
        var phone = $('#phone').val();
        var state = $('#state').val();
        var age = $('#age').val();
        var address = $('#address').val();
        $.post("../controller/update.php",{name:name,city:city,country:country,phone:phone,state:state,age:age,address:address},function(data,status){
            if(data.status == '1'){
                alert('Info Updated Succseefully');
            } else{
                alert('Error While Updating !!');
            }
        });
    });
    $('#logout').click(function(){
        window.location.href= '../controller/logout.php';
    });
});