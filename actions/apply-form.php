<?php

// ============================================================
// Debug mode (production me OFF kar dena)
// ============================================================
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ============================================================
// DB Config
// ============================================================


$host    = DB_HOST;
$db      = DB_NAME;
$user    = DB_USER;
$pass    = DB_PASS;
$charset = DB_CHAERSET;

// ============================================================
// Database Connection
// ============================================================

function getDB($host, $db, $user, $pass, $charset)
{
    try {

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {

        die("Database Connection Failed: " . $e->getMessage());
    }
}

function createLoanTable($pdo)
{
    $sql = "
        CREATE TABLE IF NOT EXISTS loan_applications (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            number VARCHAR(15) NOT NULL,
            email VARCHAR(150) NOT NULL,
            pan_card VARCHAR(10) NOT NULL,
            city VARCHAR(100) DEFAULT NULL,
            salary DECIMAL(12,2) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ";

    $pdo->exec($sql);
}

// ============================================================
// Connect DB
// ============================================================

$pdo = getDB($host, $db, $user, $pass, $charset);

// ============================================================
// IMPORTANT:
// First time only uncomment below line,
// ============================================================

// createLoanTable($pdo);

// ============================================================
// Form Handling
// ============================================================

$errors  = [];
$success = false;
$old     = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ========================================================
    // Sanitize Inputs
    // ========================================================

    $old['name']    = trim($_POST['name'] ?? '');
    $old['number']  = trim($_POST['number'] ?? '');
    $old['email']   = trim($_POST['email'] ?? '');
    $old['panCard'] = strtoupper(trim($_POST['panCard'] ?? ''));
    $old['city']    = trim($_POST['city'] ?? '');
    $old['salary']  = trim($_POST['salary'] ?? '');

    // ========================================================
    // Validation
    // ========================================================

    if (empty($old['name'])) {

        $errors['name'] = "Name is required.";
    } elseif (!preg_match('/^[a-zA-Z\s]{2,100}$/', $old['name'])) {

        $errors['name'] = "Name must contain only letters.";
    }

    if (empty($old['number'])) {

        $errors['number'] = "Mobile number is required.";
    } elseif (!preg_match('/^[6-9]\d{9}$/', $old['number'])) {

        $errors['number'] = "Enter valid 10-digit mobile number.";
    }

    if (empty($old['email'])) {

        $errors['email'] = "Email is required.";
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {

        $errors['email'] = "Enter valid email.";
    }

    if (empty($old['panCard'])) {

        $errors['panCard'] = "PAN number is required.";
    } elseif (!preg_match('/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/', $old['panCard'])) {

        $errors['panCard'] = "Invalid PAN format.";
    }

    if (
        !empty($old['salary']) &&
        (!is_numeric($old['salary']) || $old['salary'] < 0)
    ) {

        $errors['salary'] = "Enter valid salary.";
    }

    // ========================================================
    // Save Data
    // ========================================================

    if (empty($errors)) {

        try {

            $stmt = $pdo->prepare("
                INSERT INTO loan_applications
                (
                    name,
                    number,
                    email,
                    pan_card,
                    city,
                    salary
                )
                VALUES
                (
                    :name,
                    :number,
                    :email,
                    :pan_card,
                    :city,
                    :salary
                )
            ");

            $stmt->execute([
                ':name'     => $old['name'],
                ':number'   => $old['number'],
                ':email'    => $old['email'],
                ':pan_card' => $old['panCard'],
                ':city'     => $old['city'],
                ':salary'   => $old['salary'] !== ''
                    ? $old['salary']
                    : null,
            ]);

            $success = true;
            $old = [];
        } catch (PDOException $e) {

            $errors['db'] = $e->getMessage();
        }
    }
}
