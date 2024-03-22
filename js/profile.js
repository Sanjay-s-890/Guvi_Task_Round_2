$(document).ready(function() {

    $.ajax({
        url: '../php/profile.php',
        type : 'GET',
        data : {
            email : localStorage.getItem('current_loggedin_email')
        },
        
        success : function(response){
            document.querySelector('#my-form input[name="email"]').value = response.email;
            document.querySelector('#my-form input[name="name"]').value = response.name;
            document.querySelector('#my-form input[name="dob"]').value = response.dob;
        },
        error : function(xhr, status, error){
            console.log('Error: '+ error);
        }
    });
});

function putRequest(e){
    const email = $('new_email').val();
    const name = $('new_name').val();
    const dob = $('new_dob').val();
    e.preventDefault();
    $.ajax({
        url: '../php/profile.php',
        type: 'PUT',
        data: {
            name : name,
            email : email,
            dob : dob
        },
        success: function(response) {
            if (response == 'success') {
                alert('Profile updated successfully!');
                document.querySelector('#my-form input[name="email"]').value = email;
                document.querySelector('#my-form input[name="name"]').value = name;
                document.querySelector('#my-form input[name="dob"]').value = dob;
            } else {
                alert('Error updating profile!');
            }
        }
    });
}