function addStu() {
    var stuuname = $("#uname").val();
    var stuemail = $("#email").val();
    var stupass = $("#password").val();
    var stuconpass = $("#confirm_password").val();
    // console.log(stuuname);
    // console.log(stuemail);
    // console.log(stupass);
    // console.log(stuconpass);

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
                    $("#AdminEmail").html(`<small style="color:red;">* ${response.errors['AdminLogEmail']}</small>`);
                }
                if(response.errors['AdminLogPassword']){
                    $("#AdminPassword").html(`<small style="color:red;">* ${response.errors['AdminLogPassword']}</small>`);
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

// Empty all fields
function clearAdminLogFeild() {
    $('#AdminLogForm').trigger("reset");
    $("#AdminEmail").html("");
    $("#AdminPassword").html("");
    $(".AdminLogErr").html("");
}