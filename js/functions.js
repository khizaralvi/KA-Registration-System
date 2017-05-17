

/***********Login**********/
function validateLoginUsername (username) {
    var error = document.getElementById('errorUsername');
    var usernameField = document.getElementById('username');
    var num_of_errors = 0;

    if (username == "") {
        error.innerHTML = "Please enter username";
        usernameField.style.border="2px groove #CD2627";
        num_of_errors ++;
    }
    else {
        error.innerHTML = "";
        usernameField.style.border="";
    }

    if (num_of_errors > 0) {
        event.preventDefault();
    }
}

function validateLoginPassword (password) {
    var error = document.getElementById('passwordError');
    var passwordField = document.getElementById('password');
    var num_of_errors = 0;

    if (password == "") {
        error.innerHTML = "Please enter password";
        passwordField.style.border="2px groove #CD2627";
        num_of_errors ++;
    }
    else {
        error.innerHTML = "";
        passwordField.style.border="";
    }

    if (num_of_errors > 0) {
        event.preventDefault();
    }
}



 function validateLogin() {
    var inputs = document.getElementsByClassName('login');
    for (i = 0; i < inputs.length; i++) {         
            if (inputs[i].name == "username") {
                validateLoginUsername(inputs[i].value);
       }
            if (inputs[i].name == "password") {
                validateLoginPassword(inputs[i].value);
        }
    }
}




/***********Account Management**********/
function validateFirstName (first_name) {
    var error = document.getElementById('errorFirstName');
    var firstNameField = document.getElementById('first_name');
    var num_of_errors = 0;

    if (first_name == "") {
        error.innerHTML = "Please enter first name";
        firstNameField.style.border="2px groove #CD2627";
        num_of_errors ++;
    }
    else {
        error.innerHTML = "";
        firstNameField.style.border="";
    }

    if (num_of_errors > 0) {
        event.preventDefault();
    }
}

function validateLastName (last_name) {
    var error = document.getElementById('errorLastName');
    var lastNameField = document.getElementById('last_name');
    var num_of_errors = 0;

    if (last_name == "") {
        error.innerHTML = "Please enter last name";
        lastNameField.style.border="2px groove #CD2627";
        num_of_errors ++;
    }
    else {
        error.innerHTML = "";
        lastNameField.style.border="";
    }

    if (num_of_errors > 0) {
        event.preventDefault();
    }
}

function validateDateOfBirth(dateOfBirth) {
    var error = document.getElementById('errorDateOfBirth');
    var dobField = document.getElementById('date_of_birth');
    var num_of_errors = 0;
    var currentDate = new date(); 

    if (dateOfBirth > currentDate) {
        error.innerHTML = "Date of birth cannot be in future";
        dobField.style.border = "2px groove #CD2627";
        num_of_errors ++;
    }
    else {
        error.innerHTML = "";
        dobField.style.border="";
    }
    if (num_of_errors > 0) {
        event.preventDefault();
    }
}


function validateUsername(username) {
    var error = document.getElementById('errorUsername');
    var firstNameFIeld = document.getElementById('username');
    var num_of_errors = 0;

    if (username == "") {
        error.innerHTML = "Please choose a username";
        firstNameFIeld.style.border="2px groove #CD2627";
        num_of_errors ++;
    }
    else if (username.length >= 1 && username.length < 5) {
        error.innerHTML = "Username must be atleast 5 characters long";
        firstNameFIeld.style.border="2px groove #CD2627";
        num_of_errors ++;
    }
    else if (/[^a-zA_Z0-9_-]/.test(username)) {
        error.innerHTML = "Only a-z, A-Z, 0-9, - and _ allowed in username.";
        firstNameFIeld.style.border="2px groove #CD2627";
        num_of_errors ++;
    }
    else {
        error.innerHTML = "";
        firstNameFIeld.style.border="";
    }

    if (num_of_errors > 0) {
        event.preventDefault();
    }
}

function validateEmail(email) {
    var error = document.getElementById('errorEmail');
    var emailField = document.getElementById('email_address');
    var num_of_errors = 0;
   /* if (!((email.indexOf(".") > 0) && (email.indexOf("@") > 0)) 
        || /[^a-zA-Z0-9_-]/.test(email)) {
            error.innerHTML = "The Email Address is invalid";
            emailField.style.border="2px groove #CD2627";
        }*/
        if (email == "") {
        error.innerHTML = "Please enter your email";
        emailField.style.border="2px groove #CD2627";
        num_of_errors ++;
        }   
        else if (!/\S+@\S+\.\S+/.test(email)) {
            error.innerHTML = "The Email Address is invalid";
            emailField.style.border="2px groove #CD2627";
            num_of_errors ++;
        }
        else {
            error.innerHTML = "";
            emailField.style.border="";
        }

        if (num_of_errors > 0) {
            event.preventDefault();
        }
}

function validateNumber(number) {
    var error = document.getElementById('errorNumber');
    var numberField = document.getElementById('number');
    var num_of_errors = 0;

    if (number == "") {
        error.innerHTML = "Please choose a number";
        numberField.style.border="2px groove #CD2627";
        num_of_errors ++;
    }
  else if (!/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/.test(number)) {
            error.innerHTML = "The Phone Number is invalid";
            numberField.style.border="2px groove #CD2627";
            num_of_errors ++;
        }
   else {
            error.innerHTML = "";
            numberField.style.border="";
        }

    if (num_of_errors > 0) {
            event.preventDefault();
        }

}

function validatePassword(password) {
    var error = document.getElementById('passwordError');
    var passwordField = document.getElementById('password');
    var num_of_errors = 0;

    if (password == "") {
        error.innerHTML = "Please choose a password";
        passwordField.style.border="2px groove #CD2627";
        num_of_errors ++;
    }
    else if (password.length >= 1 && password.length < 6) {
        error.innerHTML = "Password must be at least 6 characters long";
        passwordField.style.border="2px groove #CD2627";
        num_of_errors ++;
    }
    else if (!/[a-z]/.test(password) || !/[A-Z]/.test(password) || !/[0-9]/.test(password)) {
        error.innerHTML = "Password requires 1 each of a-z, A-Z and 0-9";
        passwordField.style.border="2px groove #CD2627";
        num_of_errors ++;
    }
    else {
        error.innerHTML = "";
        passwordField.style.border="";
    }

    if (num_of_errors > 0) {
        event.preventDefault();
    }
}

/**function validateSalary(partTimeSalary, fullTimeSalary) {
    var partTimeSalaryField = document.getElementById('hourly_salary');
    var fullTimeSalaryField = document.getElementById('yearly_salary');
    var num_of_errors = 0;

    if (partTimeSalary == "" && fullTimeSalary == "") {
        document.getElementById('errorYearlySalary').innerHTML = "Please enter salary JavaScript";
        document.getElementById('errorHourlySalary').innerHTML = "Please enter salary JavaScript";
        partTimeSalaryField.style.border = "2px groove #CD2627";
        fullTimeSalaryField.style.border = "2px groove #CD2627"; 
        num_of_errors++;     
    }
    else if (partTimeSalary !== "" && fullTimeSalary !== "") {
        document.getElementById('errorYearlySalary').innerHTML = "Only one field required for salary JavaScript";
        document.getElementById('errorHourlySalary').innerHTML = "Only one field required for salary JavaScript"; 
        partTimeSalaryField.style.border = "2px groove #CD2627";
        fullTimeSalaryField.style.border = "2px groove #CD2627"; 
        num_of_errors++;  
    }
    else {
        document.getElementById('errorYearlySalary').innerHTML = "";
        document.getElementById('errorHourlySalary').innerHTML = ""; 
        partTimeSalaryField.style.border = "";
        fullTimeSalaryField.style.border = ""; 
    }
    if (num_of_errors > 0) {
        event.preventDefault();
    }
}**/

function validateSalary2(partTimeSalary) {
    var partTimeSalaryField = document.getElementById('hourly_salary');
    var fullTimeSalaryField = document.getElementById('yearly_salary');
    var num_of_errors = 0;

if (fullTimeSalaryField.readOnly == true && partTimeSalaryField.readOnly == false) {
    if (partTimeSalary == "") {
        document.getElementById('errorHourlySalary').innerHTML = "Please enter salary";
        partTimeSalaryField.style.border = "2px groove #CD2627";
        document.getElementById('errorYearlySalary').innerHTML = "";
        fullTimeSalaryField.style.border = ""; 
        num_of_errors++;     
    }
}

else if(partTimeSalaryField.readOnly == true && fullTimeSalaryField.readOnly == false) {
    if (fullTimeSalaryField.value == "") {
        document.getElementById('errorYearlySalary').innerHTML = "Please enter salary";
        fullTimeSalaryField.style.border = "2px groove #CD2627";
        document.getElementById('errorHourlySalary').innerHTML = "";
        partTimeSalaryField.style.border = "";
        num_of_errors++;     
    }
}
else {
        document.getElementById('errorYearlySalary').innerHTML = "";
        document.getElementById('errorHourlySalary').innerHTML = ""; 
        partTimeSalaryField.style.border = "";
        fullTimeSalaryField.style.border = ""; 
    }

  if (partTimeSalary !== "" && fullTimeSalaryField.value !== "") {
        document.getElementById('errorYearlySalary').innerHTML = "Only one field required for salary";
        document.getElementById('errorHourlySalary').innerHTML = "Only one field required for salary"; 
        partTimeSalaryField.style.border = "2px groove #CD2627";
        fullTimeSalaryField.style.border = "2px groove #CD2627"; 
        num_of_errors++;  
    }

    if (num_of_errors > 0) {
        event.preventDefault();
    }
}

function validatePasswordMatch(confirmPassword) {
    var passwordField = document.getElementById('password');
    var passwordError = document.getElementById('passwordError');
    var confirmPasswordField = document.getElementById('confirmPassword');
    var confirmPasswordError = document.getElementById('confirmPasswordError');
    
    if (confirmPassword !== "") {
        if (confirmPassword !== passwordField.value && passwordField.value !== confirmPassword) {
        passwordField.style.border = "2px groove #CD2627";
        passwordError.innerHTML = "Passwords don't match";
        confirmPasswordField.style.border = "2px groove #CD2627";
        confirmPasswordError.innerHTML = "Passwords don't match";
        event.preventDefault();
    }
       else {
        passwordField.style.border = "";
        passwordError.innerHTML = "";
        confirmPasswordField.style.border = "";
        confirmPasswordError.innerHTML = "";
       }
  }
}

function validatePasswordAjax(password) {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("oldPasswordError").innerHTML=this.responseText;
    }
    if (document.getElementById("oldPasswordError").innerHTML.trim() !== "") {
           document.getElementById('oldPassword').style.border = "2px groove #CD2627";
    }
    else {
         document.getElementById('oldPassword').style.border = "";
    }
  }
  //var data = "pass="+password; 
  xmlhttp.open("GET","ajax_requests.php?pass="+password,true);
  //xmlhttp.open("POST","ajax_requests.php",true);
  xmlhttp.send();
  
  var form = document.getElementById('changePassword');
      form.addEventListener("submit", function() {
        if (document.getElementById("oldPasswordError").innerHTML.trim() !== "") {
           document.getElementById('oldPassword').style.border = "2px groove #CD2627";
           event.preventDefault();
      }
    });
}

 function validate() {
    var error = document.getElementById('errors');
    var inputs = document.getElementsByClassName('signup');
    var partTimeSalary = document.getElementById('hourly_salary');
    var fullTimeSalary = document.getElementById('yearly_salary');
    for (i = 0; i < inputs.length; i++) {         

            if (inputs[i].name == "username") {
               validateUsername(inputs[i].value);
            }

              //if (inputs[i].name == "date_of_birth") {
             // validateDateOfBirth(inputs[i].value);
           // }
            
            if (inputs[i].name == "email_address") {
               validateEmail(inputs[i].value);
            }

            if (inputs[i].name == "first_name") {
               validateFirstName(inputs[i].value);
            }

            if (inputs[i].name == "last_name") {
               validateLastName(inputs[i].value);
            }

            if (inputs[i].name == "password") {
               validatePassword(inputs[i].value);
            }
             if (inputs[i].name == "number") {
               validateNumber(inputs[i].value);
            }
            if (inputs[i].name == "hourly_salary") {
               validateSalary2(inputs[i].value);
            }
}

 }

/***********General**********/

function validateEmptyFields() {
    var elements = document.getElementsByTagName('input');
    var sElements = document.getElementsByTagName('select');
    var errorMsg = document.getElementById('errorMsg');
    for (i = 0; i < elements.length; i++) {
        if (elements[i].value == "") {
            elements[i].style.border = "2px groove #CD2627";
            event.preventDefault();
            //errorMsg.className += " w3-red";
            errorMsg.classList.add('w3-red');
            errorMsg.innerHTML = "Please enter required fields";
        }
        else {
            elements[i].style.border = "";
        }
    }
    for (i = 0; i < sElements.length; i++) {
        if (sElements[i].value == "" || sElements[i].value == "Null" ) {
            sElements[i].style.border = "2px groove #CD2627";
            event.preventDefault();
            //errorMsg.className += " w3-red";
            errorMsg.classList.add('w3-red');
            errorMsg.innerHTML = "Please enter required fields";
        }
        else {
            sElements[i].style.border = "";
        }
    }

}

function validateSearch(form) {
    var field = 0;
    elements = document.getElementById(form).elements;
    for (var i = 0; i < elements.length; i++) {
        if (elements[i].value !== "") {
            field++;
        }
    }
    if (field == 0) {
        event.preventDefault();
        errorMsg.classList.add('w3-red');
        errorMsg.innerHTML = "Please fill atleast one field";
        }
    }

function confirmAcion(){
    console.warn("inside");
    if(confirm("Do you really want to do this?"))
        document.forms[0].submit();
    else
        return false;
}


/**function validateDeleteForm() {
    var checkboxes = document.getElementsByName('checkbox[]');
    for (i = 0; i < checkboxes.length; i++) {
        if (checkboxes.checked == false) {
            alert('Please select one of the checkboxes to delete user');
            event.preventDefault();
            break;
        }
    }
}*/

