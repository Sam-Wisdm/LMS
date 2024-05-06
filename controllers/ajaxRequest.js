function addStu() {
    var stuuname = $("#uname").val();
    var stuemail = $("#email").val();
    var stupass = $("#password").val();
    var stuconpass = $("#confirm_password").val();
    // console.log(stuuname);
    // console.log(stuemail);
    // console.log(stupass);
    // console.log(stuconpass);

    let err = validateaddStu(stuuname, stuemail, stupass, stuconpass);

    if(isEmptyObj(err)) {

        $.ajax({
            url: '../controllers/addStudent.php',
            method: 'POST',
            dataType: 'json',
            data: {
                stusignup : "stu_sign_up",
                stuuname : stuuname,
                stuemail : stuemail,
                stupass : stupass,
                stuconpass : stuconpass,
            },
            success: function (response) {
                console.log(response);
                if(response.success){
                    console.log("Registration successful");
                    $('#RegsuccessMsg').html("<span class='alert alert-success'>Registration successful!</span>");
                    clearStuRegFeild();
                } else {
                    console.log("Registration failed");
                    console.log("Errors:", response.errors);
                    $('#RegsuccessMsg').html("<span class='alert alert-danger'>Registration Failed!</span>");

                    // Display errors on Registration Form
                    if(response.errors['stuuname']){
                        $("#stuunameerr").html(`<small style="color:red;">* ${response.errors['stuuname']}</small>`);
                    }
                    if(response.errors['stuemail']){
                        $("#stuemailerr").html(`<small style="color:red;">* ${response.errors['stuemail']}</small>`);
                    }
                    if(response.errors['stupass']){
                        $("#stupasswerr").html(`<small style="color:red;">* ${response.errors['stupass']}</small>`);
                    }
                    if(response.errors['stuconpass']){
                        $("#stuconpasswerr").html(`<small style="color:red;">* ${response.errors['stuconpass']}</small>`);
                    }
                    $('#uname').on("focus", function () {
                        $("#stuunameerr").html("");
                    });
                    $('#email').on("focus", function () {
                        $("#stuemailerr").html("");
                    });
                    $('#password').on("focus", function () {
                        $("#stupasswerr").html("");
                    });
                    $('#confirm_password').on("focus", function () {
                        $("#stuconpasswerr").html("");
                    });
                }
            }
        });
    }
    else {
        console.log('js validation');
        $('#RegsuccessMsg').html("<span class='alert alert-danger'>Registration Failed!</span>");

        // Display errors on Registration Form
        if(err['stuuname']){
            $("#stuunameerr").html(`<small style="color:red;">* ${err['stuuname']}</small>`);
        }
        if(err['stuemail']){
            $("#stuemailerr").html(`<small style="color:red;">* ${err['stuemail']}</small>`);
        }
        if(err['stupass']){
            $("#stupasswerr").html(`<small style="color:red;">* ${err['stupass']}</small>`);
        }
        if(err['stuconpass']){
            $("#stuconpasswerr").html(`<small style="color:red;">* ${err['stuconpass']}</small>`);
        }
        $('#uname').on("focus", function () {
            $("#stuunameerr").html("");
        });
        $('#email').on("focus", function () {
            $("#stuemailerr").html("");
        });
        $('#password').on("focus", function () {
            $("#stupasswerr").html("");
        });
        $('#confirm_password').on("focus", function () {
            $("#stuconpasswerr").html("");
        });
    }
}

// validate student 
function validateaddStu(stuuname, stuemail, stupass, stuconpass) {
    let err = {};
    if (stuemail === "") {
        err["stuemail"] = "Email is required.";
    } else if (!stuemail.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
        err["stuemail"] = "Invalid email address.";
    } 
    
    if (stuuname === "") {
        err["stuuname"] = "Username is required.";
    }
    
    if (stupass === "") {
        err["stupass"] = "Password is required.";
    } else if (stupass.length < 5) {
        err["stupass"] = "Password must contain minimum 5 characters.";
    }
    
    if (stuconpass === "") {
        err["stuconpass"] = "Confirm Password is required.";
    } else if (stuconpass !== stupass) {
        err["stuconpass"] = "Confirm Password must be same as Password.";
    }

    return err;
}

// Empty all fields
function clearStuRegFeild() {
    $('#stuRegForm').trigger("reset");
    $("#uname").html("");
    $("#email").html("");
    $("#password").html("");
    $("#confirm_password").html("");
    $(".stuRegErr").html("");
}


// Ajax call for Student Login Verification
function checkStuLogin(){
    var stuLogEmail = $('#Logemail').val();
    var stuLogPassw = $('#Logpassw').val();
    // console.log(stuLogEmail, stuLogPassw)

    let err = validatecheckStuLogin(stuLogEmail, stuLogPassw);

    if(isEmptyObj(err)) {
        
        $.ajax({
            url: '../controllers/checkStudent.php',
            method: "POST",
            dataType: 'json',
            data:{
                checkStuLogin: "checklogin",
                stuLogEmail: stuLogEmail,
                stuLogPassw: stuLogPassw,
            },
            success: function (response) {
                console.log(response);
                if(response.success){
                    console.log("Login successful");
                    $('#LogsuccessMsg').html("<span class='alert alert-success'>Login successful!</span>");
                    window.location.href = '/';
                    clearStuLogFeild();
                } else {
                    console.log("Login failed");
                    console.log("Errors:", response.errors);
                    $('#LogsuccessMsg').html("<span class='alert alert-danger'>Login Failed!</span>");

                    // Display errors on Login Form
                    if(response.errors['stuLogEmail']){
                        $("#stuLogemailerr").html(`<small style="color:red;">* ${response.errors['stuLogEmail']}</small>`);
                    }
                    if(response.errors['stuLogPassw']){
                        $("#stuLogpasswerr").html(`<small style="color:red;">* ${response.errors['stuLogPassw']}</small>`);
                    }
                    $('#Logemail').on("focus", function () {
                        $("#stuLogemailerr").html("");
                    });
                    $('#Logpassw').on("focus", function () {
                        $("#stuLogpasswerr").html("");
                    });
                }
            }
        });
    }
    else {
        console.log('js validation');
        $('#LogsuccessMsg').html("<span class='alert alert-danger'>Login Failed!</span>");

        // Display errors on Login Form
        if(err['stuLogEmail']){
            $("#stuLogemailerr").html(`<small style="color:red;">* ${err['stuLogEmail']}</small>`);
        }
        if(err['stuLogPassw']){
            $("#stuLogpasswerr").html(`<small style="color:red;">* ${err['stuLogPassw']}</small>`);
        }
        $('#Logemail').on("focus", function () {
            $("#stuLogemailerr").html("");
        });
        $('#Logpassw').on("focus", function () {
            $("#stuLogpasswerr").html("");
        });
    }
}

function validatecheckStuLogin(stuLogEmail, stuLogPassw) {
    let err = {};
    if(stuLogEmail === "") {
        err.stuLogEmail = "Email is required.";
    }
    else if(!stuLogEmail.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
        err.stuLogEmail = "Invalid email address.";
    }
    if(stuLogPassw === "") {
        err.stuLogPassw = "Password required.";
    }

    return err;
}

// Empty all fields
function clearStuLogFeild() {
    $('#stuLogForm').trigger("reset");
    $("#email").html("");
    $("#password").html("");
    $(".stuLogErr").html("");
}

// Ajax call for Admin Login Verification
function adminlogin(){
    var AdminLogEmail = $('#AdminEmail').val();
    var AdminLogPassw = $('#AdminPassword').val();
    // console.log(AdminLogEmail, AdminLogPassw);

    let err = validateAdminLog(AdminLogEmail, AdminLogPassw);

    if(isEmptyObj(err)) {
        
        $.ajax({
            url: '../controllers/checkAdmin.php',
            method: "POST",
            dataType: 'json',
            data:{
                checkAdminLogin: "checklogin",
                AdminLogEmail: AdminLogEmail,
                AdminLogPassw: AdminLogPassw,
            },
            success: function (response) {
                console.log(response);
                if(response.success){
                    console.log("Login successful");
                    $('#AminLogsuccessMsg').html("<span class='alert alert-success'>Admin Login successful!</span>");
                    window.location.href = './views/adminDashboard.php';
                    clearAdminLogFeild();
                } else {
                    console.log("Login failed");
                    console.log("Errors:", response.errors);
                    $('#AminLogsuccessMsg').html("<span class='alert alert-danger'>Admin Login Failed!</span>");

                    // Display errors on Admin Login Form
                    if(response.errors['AdminLogEmail']){
                        $("#AdminEmailErr").html(`<small style="color:red;">* ${response.errors['AdminLogEmail']}</small>`);
                    }
                    if(response.errors['AdminLogPassw']){
                        $("#AdminPasswordErr").html(`<small style="color:red;">* ${response.errors['AdminLogPassw']}</small>`);
                    }
                    $('#AdminEmail').on("focus", function () {
                        $("#AdminEmailErr").html("");
                    });
                    $('#AdminPassword').on("focus", function () {
                        $("#AdminPasswordErr").html("");
                    });
                }
            }
        });
    }
    else {
        console.log('js validation');
        $('#AminLogsuccessMsg').html("<span class='alert alert-danger'>Admin Login Failed!</span>");

        // Display errors on Admin Login Form
        if(err['AdminLogEmail']){
            $("#AdminEmailErr").html(`<small style="color:red;">* ${err['AdminLogEmail']}</small>`);
        }
        if(err['AdminLogPassw']){
            $("#AdminPasswordErr").html(`<small style="color:red;">* ${err['AdminLogPassw']}</small>`);
        }
        $('#AdminEmail').on("focus", function () {
            $("#AdminEmailErr").html("");
        });
        $('#AdminPassword').on("focus", function () {
            $("#AdminPasswordErr").html("");
        });
    }
}

function validateAdminLog(AdminLogEmail, AdminLogPassw) {
    let err = {};

    if(AdminLogEmail === "") {
        err['AdminLogEmail'] = "Email Required";
    }
    else if(!AdminLogEmail.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
        err['AdminLogEmail'] = "Invalid Email Address. 4";
    }
    if(AdminLogPassw === "") {
        err['AdminLogPassw'] = "Password Required.";
    }

    return err;
}

// Empty all fields
function clearAdminLogFeild() {
    $('#AdminLogForm').trigger("reset");
    $("#AdminEmail").html("");
    $("#AdminPassword").html("");
    $(".AdminLogErr").html("");
}

function isEmptyObj(obj) {
    for (var prop in obj) {
      if (Object.prototype.hasOwnProperty.call(obj, prop)) {
        return false;
      }
    }
  
    return true
  }