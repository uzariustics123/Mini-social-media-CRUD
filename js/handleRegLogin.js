$(function(){
    $('.form-login').on('submit',function(event){
event.preventDefault();
      var loginemail = $('#login-email').val();
      let loginpass = $('#login-password').val();
      const emailValue = loginemail.trim(); // Trim whitespaces from email
        const passwordValue = loginpass.trim();
      if(emailValue !== "" || passwordValue !== ""){
        loginUser(loginemail, loginpass);
      }else{
        alert('invalid email or password');
      }
      
    });

    $('.form-signup').on('submit',function(event){
      event.preventDefault();
            var email = $('#signup-email').val();
            let firstname = $('#signup-firstname').val();
            let lastname = $('#signup-lastname').val();
            let password = $('#signup-password').val();
            let confirmpass = $('#signup-password-confirm').val();
            const emailValue = email.trim(); // Trim whitespaces from email
              const passwordValue = password.trim();
            if(emailValue === "" || passwordValue === ""){
              Swal.fire({
                title: "Ooops!",
                text: "Email or password should not be empty",
                icon: "warning",
                showConfirmButton: true
              });
            }else if(password !== confirmpass){
              Swal.fire({
                title: "Ooops!",
                text: "password and confirm password should match",
                icon: "warning",
                showConfirmButton: true
              });
            }
            else{
              registerUser(email,password, firstname, lastname);
            }
            
          });

  })

  function loginUser(email, password){
            $.ajax({
          url: 'api/loginUser.php',
          method: 'POST',
          data: {email: email, password: password},
          success: function(response) {
              // Code to execute when the request is successful
              let res = JSON.parse(response);
              if(res.status == 'success'){
                Swal.fire({
                  title: "Logged in successfully!",
                  text: "Awesome! you can now proceed",
                  icon: "success",
                  showConfirmButton: true
                }).then(function() {
                window.location.href = 'main.php';
              });
              }
              else{
                Swal.fire({
                  title: "Ooops!",
                  text: "No user matches with the given email and passowrd.",
                  icon: "error",
                  showConfirmButton: true
                });
              }
          },
          error: function(xhr, status, error) {
              // Code to execute when the request fails
              Swal.fire({
                title: "Ooops!",
                text: "We cannot get you in, something went wrong.",
                icon: "error",
                showConfirmButton: true
              });
              alert('');
              console.log('Error:', error);
          }
        });
  }


  function registerUser(email, password, firstname, lastname){
    $.ajax({
      url: 'api/regUser.php',
      method: 'POST',
      data: {email: email, password: password, firstname: firstname, lastname: lastname},
      success: function(response) {
      // Code to execute when the request is successful
      console.log(response);
      let res = JSON.parse(response);
      if(res.status == 'success'){
        Swal.fire({
          title: "Registration successful!",
          text: "You can now log in using your account",
          icon: "success"
        });
      }else{
        Swal.fire({
          title: "Oops!",
          text: "Something went wrong please try again",
          icon: "error"
        });
      }
  },
  error: function(xhr, status, error) {
      // Code to execute when the request fails
      alert('Something went wrong please try again');
      console.log('Error:', error);
  }
});
}