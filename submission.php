<?php
$username = "";
$email = "";
$age = "";
$password = "";
$confirm_password = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $age = trim($_POST["age"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // التحقق من المدخلات
    if (empty($username)) {
        $errors['username'] = "Username is required";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    if (empty($age)) {
        $errors['age'] = "Age is required";
    } elseif (!is_numeric($age)) {
        $errors['age'] = "Age must be a number";
    } elseif ($age < 18) {
        $errors['age'] = "You must be at least 18 years old";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters long";
    }

    if (empty($confirm_password)) {
        $errors['confirm_password'] = "Confirm password is required";
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match";
    }

    if (empty($errors)) {
        echo "<h2 style='color: green;'>Form  successfully!</h2>";
        echo "<p><strong>Username:</strong> " . htmlspecialchars($username) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
        echo "<p><strong>Age:</strong> " . htmlspecialchars($age) . "</p>";
    } else {
        echo "<h2 style='color: red;'>There were errors in your submission:</h2>";
        echo "<ul>";
        foreach ($errors as $field => $error) {
            echo "<li><strong>" . ucfirst($field) . ":</strong> " . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";

        echo "<p><a href='validation.php'>Go back to the validation page</a></p>";
    }
}
?>