<?php
require __DIR__ . "/config.php";
require __DIR__ . "/actions/apply-form.php";

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Awaiken">
    <title>Loan For Salaried || Apply Now</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo1.png">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Onest:wght@400;700&display=swap" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="assets/css/slicknav.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link href="assets/css/all.css" rel="stylesheet" media="screen">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/mousecursor.css">
    <link href="assets/css/custom.css" rel="stylesheet" media="screen">

    <style>
        .form-control.is-invalid {
            border-color: #dc3545;
            background-image: none;
        }

        .invalid-feedback {
            display: block;
            font-size: 0.80rem;
            color: #dc3545;
            text-align: left;
            margin-top: 4px;
        }

        .alert-success-box {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            border-radius: 10px;
            padding: 18px 24px;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 1rem;
        }

        .alert-error-box {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            border-radius: 10px;
            padding: 14px 20px;
            margin-bottom: 16px;
            font-size: 0.88rem;
        }
    </style>
</head>

<body>

    <!-- Preloader Start -->
    <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon">
                <img src="assets/images/logo1.png" style="border-radius: 30px;" alt="">
            </div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="topbar-info-content">
                        <p><a href="#">Om namo bhagwate vasudevaya namah 🕉️</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="main-header">
        <div class="header-sticky">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="./" style="background-color: white; padding: 5px; border-radius: 8px;">
                        <img src="assets/images/logo1.png" alt="Loan For Salaried Logo" style="height: 100px; width: auto;">
                    </a>
                    <div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            <ul class="navbar-nav mr-auto" id="menu">
                                <li class="nav-item"><a class="nav-link" href="./">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="./apply-now">Apply Now</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="navbar-toggle"></div>
                </div>
            </nav>
            <div class="responsive-menu"></div>
        </div>
    </header>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3" data-cursor="-opaque">Apply Now</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Apply Now</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="page-contact-us py-5">
        <div class="contact-us-form py-5">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-8 col-md-10 col-sm-12">
                        <div class="contact-form text-center px-4 py-5 shadow rounded bg-white">

                            <div class="contact-form-title wow fadeInUp mb-4">
                                <h2 class="mb-3">Fulfill Your Loan Needs with Our Quick and Best Loans</h2>
                                <p class="mb-0">
                                    Loan For Salaried offers various types of loans to individuals at the lowest
                                    interest rate in the market. Fill your details and our team will help you get your
                                    loan needs fulfilled quickly.
                                </p>
                            </div>

                            <?php if ($success): ?>
                                <!-- Success Message -->
                                <div class="alert-success-box">
                                    ✅ Your application has been submitted successfully! Our team will contact you soon.
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($errors['db'])): ?>
                                <div class="alert-error-box">
                                    ⚠️ <?= htmlspecialchars($errors['db']) ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!$success): ?>
                                <form id="" method="POST" action="apply-now.php" novalidate>

                                    <div class="row text-start">

                                        <!-- Name -->
                                        <div class="form-group col-md-6 mb-3">
                                            <input
                                                type="text"
                                                name="name"
                                                class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                                                placeholder="Enter Name"
                                                value="<?= htmlspecialchars($old['name'] ?? '') ?>">
                                            <?php if (isset($errors['name'])): ?>
                                                <div class="invalid-feedback"><?= $errors['name'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Mobile -->
                                        <div class="form-group col-md-6 mb-3">
                                            <input
                                                type="text"
                                                name="number"
                                                maxlength="10"
                                                class="form-control <?= isset($errors['number']) ? 'is-invalid' : '' ?>"
                                                placeholder="Enter Mobile Number"
                                                value="<?= htmlspecialchars($old['number'] ?? '') ?>">
                                            <?php if (isset($errors['number'])): ?>
                                                <div class="invalid-feedback"><?= $errors['number'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group col-md-6 mb-3">
                                            <input
                                                type="email"
                                                name="email"
                                                class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                                placeholder="Email Address"
                                                value="<?= htmlspecialchars($old['email'] ?? '') ?>">
                                            <?php if (isset($errors['email'])): ?>
                                                <div class="invalid-feedback"><?= $errors['email'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- PAN -->
                                        <div class="form-group col-md-6 mb-3">
                                            <input
                                                type="text"
                                                name="panCard"
                                                maxlength="10"
                                                class="form-control <?= isset($errors['panCard']) ? 'is-invalid' : '' ?>"
                                                placeholder="Enter PAN Number (e.g. ABCDE1234F)"
                                                value="<?= htmlspecialchars($old['panCard'] ?? '') ?>"
                                                style="text-transform: uppercase;">
                                            <?php if (isset($errors['panCard'])): ?>
                                                <div class="invalid-feedback"><?= $errors['panCard'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- City -->
                                        <div class="form-group col-md-6 mb-3">
                                            <input
                                                type="text"
                                                name="city"
                                                class="form-control"
                                                placeholder="Enter City"
                                                value="<?= htmlspecialchars($old['city'] ?? '') ?>">
                                        </div>

                                        <!-- Salary -->
                                        <div class="form-group col-md-6 mb-3">
                                            <input
                                                type="number"
                                                name="salary"
                                                min="0"
                                                class="form-control <?= isset($errors['salary']) ? 'is-invalid' : '' ?>"
                                                placeholder="Enter Monthly Salary"
                                                value="<?= htmlspecialchars($old['salary'] ?? '') ?>">
                                            <?php if (isset($errors['salary'])): ?>
                                                <div class="invalid-feedback"><?= $errors['salary'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Submit -->
                                        <div class="col-12 mt-2">
                                            <button type="submit" class="btn btn-primary w-100">Apply Now</button>
                                        </div>

                                    </div>
                                </form>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="about-footer">
                        <div class="footer-logo">
                            <img src="assets/images/logo1.png" style="height: 100px; width: auto; border-radius: 8px;" alt="">
                        </div>
                    </div>
                    <p class="text-white">
                        Loan For Salaried is your one-stop destination for instant personal loans during unexpected
                        financial crunches. Just like a true companion, Loan For Salaried safeguards your savings and
                        supports you in times of need by helping you meet urgent expenses with ease.
                    </p>
                </div>

                <div class="col-lg-2 col-md-3 col-6">
                    <div class="footer-links">
                        <h3>resources</h3>
                        <ul>
                            <li><a href="#">support</a></li>
                            <li><a href="#">blogance</a></li>
                            <li><a href="#">community</a></li>
                            <li><a href="#">privacy policy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6">
                    <div class="footer-links">
                        <h3>company</h3>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">about us</a></li>
                            <li><a href="#">contact</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6">
                    <div class="footer-links">
                        <h3>UseFull Link</h3>
                        <ul>
                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i> <span>Facebook</span></a></li>
                            <li><a href="#"><i class="fa-brands fa-x-twitter"></i> <span>Twitter</span></a></li>
                            <li><a href="#"><i class="fa-brands fa-instagram"></i> <span>Instagram</span></a></li>
                            <li><a href="#"><i class="fa-brands fa-linkedin-in"></i> <span>LinkedIn</span></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6">
                    <div class="footer-links">
                        <h3>Contact Us</h3>
                        <ul>
                            <li><a href="mailto:loanforsalaried@gmail.com"><i class="fa-solid fa-envelope"></i> loanforsalaried@gmail.com</a></li>
                            <li><a href="mailto:support@loanforsalaried.com"><i class="fa-solid fa-envelope"></i> support@loanforsalaried.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="footer-copyright">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="footer-copyright-text">
                            <p>Copyright © 2025 Loan For Salaried. All Rights Reserved.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="footer-social-links">
                            <ul></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/validator.min.js"></script>
    <script src="assets/js/jquery.slicknav.js"></script>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/SmoothScroll.js"></script>
    <script src="assets/js/parallaxie.js"></script>
    <script src="assets/js/gsap.min.js"></script>
    <script src="assets/js/magiccursor.js"></script>
    <script src="assets/js/SplitText.js"></script>
    <script src="assets/js/ScrollTrigger.min.js"></script>
    <script src="assets/js/jquery.mb.YTPlayer.min.js"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/function.js"></script>
    <script src="assets/js/theme-panel.js"></script>

    <!-- Client-side: PAN uppercase force + only digits in mobile -->
    <script>
        document.querySelector('[name="panCard"]').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
        document.querySelector('[name="number"]').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        });
    </script>

</body>

</html>