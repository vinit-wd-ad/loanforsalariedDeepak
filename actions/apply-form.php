<?php

$host    = DB_HOST;
$db      = DB_NAME;
$user    = DB_USER;
$pass    = DB_PASS;
$charset = DB_CHARSET;

/**
 * 1. Database aur Table Initialization 
 */
function initDatabase($host, $db, $user, $pass, $charset)
{
    try {
        $dsnWithoutDb = "mysql:host=$host;charset=$charset";
        $pdoInit = new PDO($dsnWithoutDb, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        // 1. Check & Create Database
        $pdoInit->exec("CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET $charset COLLATE {$charset}_general_ci");
        
        // 2. Database select karein
        $pdoInit->exec("USE `$db`");

        // 3. Check & Create Table
        $pdoInit->exec("CREATE TABLE IF NOT EXISTS loan_applications (
            id          INT AUTO_INCREMENT PRIMARY KEY,
            name        VARCHAR(100)  NOT NULL,
            number      VARCHAR(15)   NOT NULL,
            email       VARCHAR(150)  NOT NULL,
            pan_card    VARCHAR(10)   NOT NULL,
            city        VARCHAR(100),
            salary      DECIMAL(12,2),
            created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        return true;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * 2. Regular DB Connection Function
 */
function getDB($host, $db, $user, $pass, $charset)
{
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        return null;
    }
}

// ============================================================
//  Form handling
// ============================================================
$errors  = [];
$success = false;
$old     = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- Sanitize ---
    $old['name']    = trim($_POST['name']   ?? '');
    $old['number']  = trim($_POST['number'] ?? '');
    $old['email']   = trim($_POST['email']  ?? '');
    $old['panCard'] = strtoupper(trim($_POST['panCard'] ?? ''));
    $old['city']    = trim($_POST['city']   ?? '');
    $old['salary']  = trim($_POST['salary'] ?? '');

    // --- Validation ---
    if (empty($old['name'])) {
        $errors['name'] = "Name is required.";
    } elseif (!preg_match('/^[a-zA-Z\s]{2,100}$/', $old['name'])) {
        $errors['name'] = "Name must contain only letters (2–100 chars).";
    }

    if (empty($old['number'])) {
        $errors['number'] = "Mobile number is required.";
    } elseif (!preg_match('/^[6-9]\d{9}$/', $old['number'])) {
        $errors['number'] = "Enter a valid 10-digit Indian mobile number.";
    }

    if (empty($old['email'])) {
        $errors['email'] = "Email address is required.";
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Enter a valid email address.";
    }

    if (empty($old['panCard'])) {
        $errors['panCard'] = "PAN number is required.";
    } elseif (!preg_match('/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/', $old['panCard'])) {
        $errors['panCard'] = "Enter a valid PAN (e.g. ABCDE1234F).";
    }

    if (!empty($old['salary']) && (!is_numeric($old['salary']) || $old['salary'] < 0)) {
        $errors['salary'] = "Enter a valid salary amount.";
    }

    // --- Save to DB if no errors ---
    if (empty($errors)) {
        
        // PEHLE INITIALIZE KAREIN:

        initDatabase($host, $db, $user, $pass, $charset);

        $pdo = getDB($host, $db, $user, $pass, $charset);
        
        if ($pdo) {
            $stmt = $pdo->prepare("INSERT INTO loan_applications
                (name, number, email, pan_card, city, salary)
                VALUES (:name, :number, :email, :pan_card, :city, :salary)");
            $stmt->execute([
                ':name'     => $old['name'],
                ':number'   => $old['number'],
                ':email'    => $old['email'],
                ':pan_card' => $old['panCard'],
                ':city'     => $old['city'],
                ':salary'   => $old['salary'] !== '' ? $old['salary'] : null,
            ]);
            $success = true;
            $old = []; // clear fields after success
        } else {
            $errors['db'] = "Database connection failed. Please try again later.";
        }
    }
}