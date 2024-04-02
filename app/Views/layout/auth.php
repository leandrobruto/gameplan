<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?= site_url('assets/'); ?>"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>GamePlan | <?= $title; ?></title>

    <meta name="description" content="" />

      <!-- Favicon -->
      <link rel="icon" type="image/x-icon" href="<?= site_url('assets/img/favicon/favicon.ico'); ?>" />

      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
      />

      <!-- Icons. Uncomment required icon fonts -->
      <link rel="stylesheet" href="<?= site_url('assets/vendor/fonts/boxicons.css'); ?>" />

      <!-- Core CSS -->
      <link rel="stylesheet" href="<?= site_url('assets/vendor/css/core.css'); ?>" class="template-customizer-core-css" />
      <link rel="stylesheet" href="<?= site_url('assets/vendor/css/theme-default.css'); ?>" class="template-customizer-theme-css" />
      <link rel="stylesheet" href="<?= site_url('assets/css/demo.css'); ?>" />

      <!-- Vendors CSS -->
      <link rel="stylesheet" href="<?= site_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css'); ?>" />

      <!-- Page CSS -->
      <!-- Page -->
      <link rel="stylesheet" href="<?= site_url('assets/vendor/css/pages/page-auth.css'); ?>" />
      <!-- Helpers -->
      <script src="<?= site_url('assets/vendor/js/helpers.js'); ?>"></script>

      <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
      <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
      <script src="<?= site_url('assets/js/config.js'); ?>"></script>

      <!-- This section will render the specific styles of the view that extends this layout -->
      <?php echo $this->renderSection('styles'); ?>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      
      <!-- This section will render the view-specific scripts that extend this layout -->
      <?= $this->renderSection('content'); ?>

    </div>

    <!-- / Content -->

    <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= site_url('assets/vendor/libs/jquery/jquery.js'); ?>"></script>
    <script src="<?= site_url('assets/vendor/libs/popper/popper.js'); ?>"></script>
    <script src="<?= site_url('assets/vendor/js/bootstrap.js'); ?>"></script>
    <script src="<?= site_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'); ?>"></script>

    <script src="<?= site_url('assets/vendor/js/menu.js'); ?>"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?= site_url('assets/js/main.js'); ?>"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->

    <!-- Essa section renderizará os scripts específicos da view que estender esse layout -->
    <?= $this->renderSection('scripts'); ?>
     
  </body>
</html>