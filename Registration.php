<?php
require "database.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = trim($_POST["first_name"]);
    $lastName = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $mobile = trim($_POST["mobile"]);
    $accountType = $_POST["account_type"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    if (
        empty($firstName) || empty($lastName) || empty($email) ||
        empty($mobile) || empty($accountType) ||
        empty($password) || empty($confirmPassword)
    ) {
        $error = "Please complete all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (!preg_match("/^[0-9]{12}$/", $mobile)) {
        $error = "Mobile number must contain exactly 12 digits.";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } elseif (!in_array($accountType, ["jobseeker", "employer"])) {
        $error = "Please select a valid account type.";
    } else {
        $checkUser = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $checkUser->execute([$email]);

        if ($checkUser->fetch()) {
            $error = "This email address is already registered.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insertUser = $pdo->prepare(
                "INSERT INTO users
                (first_name, last_name, email, mobile, account_type, password)
                VALUES (?, ?, ?, ?, ?, ?)"
            );

            $insertUser->execute([
                $firstName,
                $lastName,
                $email,
                $mobile,
                $accountType,
                $hashedPassword
            ]);

            header("Location: login.php?registered=1");
            exit;
            }           
       }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PESO Connect | Create Account</title>

  <style>
    :root {
      --navy: #0A2342;
      --gold: #FFC107;
      --light-blue: #EAF6FF;
      --text: #263646;
      --muted: #687888;
      --line: #DCE5EC;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, Helvetica, sans-serif;
    }

    body {
      min-height: 100vh;
      padding: 35px 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #EAF6FF, #F9FCFF);
      color: var(--text);
    }

    .container {
      width: 100%;
      max-width: 600px;
      padding: 32px;
      background: white;
      border: 1px solid var(--line);
      border-radius: 15px;
      box-shadow: 0 8px 24px rgba(10, 35, 66, 0.10);
    }

    .logo {
      color: var(--navy);
      text-align: center;
      font-size: 25px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    h1 {
      color: var(--navy);
      text-align: center;
      font-size: 22px;
      margin-bottom: 8px;
    }

    .subtitle {
      color: var(--muted);
      text-align: center;
      font-size: 14px;
      margin-bottom: 25px;
    }

    .fields {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .full {
      grid-column: 1 / -1;
    }

    label {
      display: block;
      margin-bottom: 7px;
      color: #405265;
      font-size: 13px;
      font-weight: bold;
    }

    .required {
      color: #D94343;
    }

    input,
    select {
      width: 100%;
      padding: 12px;
      border: 1px solid #C9D6E0;
      border-radius: 8px;
      outline: none;
      font-size: 14px;
    }

    input:focus,
    select:focus {
      border-color: #168DD1;
      box-shadow: 0 0 0 3px rgba(22, 141, 209, 0.12);
    }

    .terms {
      display: flex;
      gap: 8px;
      align-items: flex-start;
      margin: 20px 0;
      font-size: 13px;
      color: var(--muted);
      line-height: 1.5;
    }

    .terms input {
      width: auto;
      margin-top: 3px;
    }

    .register-btn {
      width: 100%;
      padding: 13px;
      border: none;
      border-radius: 8px;
      background: var(--gold);
      color: var(--navy);
      font-size: 15px;
      font-weight: bold;
      cursor: pointer;
    }

    .register-btn:hover {
      background: #E0AA00;
    }

    .login {
      margin-top: 18px;
      text-align: center;
      color: var(--muted);
      font-size: 14px;
    }

    .login a {
      color: var(--navy);
      font-weight: bold;
      text-decoration: none;
    }

    #message {
      display: none;
      text-align: center;
      margin-top: 15px;
      color: #188754;
      font-size: 14px;
      font-weight: bold;
    }

    @media (max-width: 600px) {
      .container {
        padding: 25px;
      }

      .fields {
        grid-template-columns: 1fr;
      }

      .full {
        grid-column: auto;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="logo">PESO Connect</div>

    <h1>Create Your Account</h1>
    <p class="subtitle">Join PESO Connect and find opportunities in Mandaluyong.</p>

    <form method="POST" action="Registration.php">
      <div class="fields">
        <div>
          <label for="firstName">First Name <span class="required">*</span></label>
          <input type="text" id="firstName" name="first_name" required placeholder="Enter first name">
        </div>

        <div>
          <label for="lastName">Last Name <span class="required">*</span></label>
          <input type="text" id="last_Name" name="last_name" required placeholder="Enter last name">
        </div>

        <div class="full">
          <label for="email">Email Address <span class="required">*</span></label>
          <input type="email" id="email" name="email" required placeholder="Enter email address">
        </div>

        <div>
          <label for="mobile">Mobile Number <span class="required">*</span></label>
          <input
            type="text"
            id="mobile"
            name="mobile"
            required
            inputmode="numeric"
            maxlength="12"
            pattern="[0-9]{12}"
            title="Mobile number must have exactly 12 digits."
            placeholder="Enter 12-digit number"
            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12)"
          >
        </div>

        <div>
          <label for="accountType">Register As <span class="required">*</span></label>
          <select id="account_type" name="account_type" required>
            <option value="">Select account type</option>
            <option value="jobseeker">Job Seeker</option>
            <option value="employer">Employer / Company</option>
          </select>
        </div>

        <div>
          <label for="password">Password <span class="required">*</span></label>
          <input
            type="password"
            id="password"
            name="password"
            required
            minlength="8"
            placeholder="Minimum 8 characters"
          >
        </div>

        <div>
          <label for="confirmPassword">Confirm Password <span class="required">*</span></label>
          <input
            type="password"
            id="confirmPassword"
            name="confirm_password"
            required
            placeholder="Enter password again"
          >
        </div>
      </div>

      <div class="terms">
        <input type="checkbox" id="terms" required>
        <label for="terms">
          I agree to the PESO Connect Terms and Conditions and Privacy Policy.
        </label>
      </div>

      <button type="submit" class="register-btn">Create Account</button>

      <p id="message">Account created successfully!</p>

      <p class="login">
        Already have an account?
        <a href="login.php">Log in</a>
      </p>
    </form>
  </div>

 </body>
</html>
