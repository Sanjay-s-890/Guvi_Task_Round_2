function execute(){
    $(document).ready(function() {
        
            var email = $("#email").val();
            var password  = $("#password").val();
            var c_password = $("#c-password").val();

            if(email === "") {
                alert("Please enter your email id.");
                return false;
        }

        if(password === ""){
            alert("Please enter your password");
            return false;
        }

            if(password !== c_password){
                alert("Check your password");
                return false;
            }
            
            $.ajax({
                type: "POST",
                url: "php/register.php",
                data: {
                    email : email,
                    upswd : password
                },
                success: function(data) {
                    console.log(data);
                    window.location.href="login.html";
                    alert(data);
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        
        });
}