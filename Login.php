<?php
session_start();
require "database.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email address"]);
    $password = $_POST["password"];

    $findUser = $pdo->prepare(
        "SELECT id, first_name, password, account_type
         FROM users
         WHERE email = ?"
    );

    $findUser->execute([$email]);
    $user = $findUser->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["first_name"] = $user["first_name"];
        $_SESSION["account_type"] = $user["account_type"];

        if ($user["account_type"] === "jobseeker") {
            header("Location: jobseeker-dashboard.html");
        } else {
            header("Location: employer-dashboard.html");
        }

        exit;
    } else {
        $error = "Incorrect email address or password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="og:title" content="PESO Connect">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PESO Connect Login</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    padding:30px 20px;
    background-image:url('unnamed.jpg');
    background-size: cover;
    background-position: center;
}

.container{
    width: 100%;
    max-width:450px;
    background: LightBlue;
    padding:35px;
    border-radius:15px;
}

.logo{
    text-align:center;
    margin-bottom:20px;
}

.logo h1{
    color:#0A2342;
}

.logo-img{
    width:90px;
    height:90px;
    border-radius:50%;
    object-fit:cover;
    display:block;
    margin:0 auto 15px;
    border:4px solid #FFC107;
    box-shadow:0 4px 10px rgba(0,0,0,0.15);
}

.logo p{
    color:#666;
    font-size:14px;
}

.form-title{
    text-align:center;
    margin-bottom:20px;
    color:#0A2342;
}

.input-group{
    margin-bottom:15px;
}

.input-group label{
    display:block;
    margin-bottom:5px;
    font-weight:600;
    color:#0A2342;
}

.input-group input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    outline:none;
}

.input-group input:focus{
    border-color:#daff07;
}

.show-password{
    margin-bottom:15px;
    font-size:14px;
}

.btn{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:#FFC107;
    color:#0A2342;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;
}

.btn:hover{
    background:#e0aa00;
}

.links{
    margin-top:15px;
    text-align:center;
}

.links a{
    text-decoration:none;
    color:#0A2342;
    font-weight:600;
}

.links a:hover{
    color:#FFC107;
}

.signup{
    margin-top:10px;
}

@media(max-width:768px){
    .container{
        max-width:90%;
        padding:25px;
    }
    .logo-img{
        width:80px;
        height:80px;
    }
}

@media(min-width:1024px){
    .container{
        max-width:500px;
        padding:40px;
    }
}

</style>
</head>
<body>

<div class="container">

    <div class="logo">
        <img src="P.E.S.O Mandaluyong Logo Official.jpg" alt="PESO Connect Logo" class="logo-img">
        <h1>PESO Connect</h1>
        <p>Connecting Job Seekers and Employers</p>
    </div>

    <h2 class="form-title">Welcome Mandaleño!</h2>

<?php if (!empty($error)): ?>
  <p style="color:#D94343; text-align:center; margin-bottom:15px;">
    <?php echo htmlspecialchars($error); ?>
  </p>
<?php endif; ?>

    <form method="POST" action="login.php">

        <div class="input-group">
            <label>Email Address</label>
            <input type="email" placeholder="Enter your email">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" id="password" placeholder="Enter your password">
        </div>

        <div class="show-password">
            <input type="checkbox" onclick="togglePassword()">
            Show Password
        </div>

        <button type="submit" class="btn">
            LOGIN
        </button>

        <div class="links">
            <a href="#">Forget Password?</a>

            <div class="signup">
                Don't have an account?<br>
                <a href="Registration.php">Create Account</a>
            </div>
        </div>
    </form>
</div>

<script>
function togglePassword(){
    var password = document.getElementById("password");

    if(password.type === "password"){
        password.type = "text";
    }
    else{
        password.type = "password";
    }
}

</script>
</body>
</html>
