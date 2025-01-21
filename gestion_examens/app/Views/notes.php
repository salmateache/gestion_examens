<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Notes</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
 <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/quill/quill.snow.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/quill/quill.bubble.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/simple-datatables/style.css') ?>" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
 
    <!-- Ajouter jQuery avant tout autre script qui l'utilise -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<?php if(session()->has('success')): ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php endif; ?>


<?php if(session()->getFlashdata('message')): ?>
    <div class="alert alert-info">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif; ?>



  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="<?= base_url('/dashboard'); ?>" class="logo d-flex align-items-center">
        <img src="<?= base_url('assets/img/logo.jpg') ?>" alt="">
        <span class="d-none d-lg-block">My exams</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="<?= base_url('assets/img/messages-1.jpg') ?>" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="<?= base_url('assets/img/messages-2.jpg') ?>" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="<?= base_url('assets/img/messages-3.jpg') ?>" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="<?= base_url('assets/img/profile-img.jpg') ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= session()->get('username'); ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
            <h6><?= session()->get('username'); ?></h6>
            <span><?= session()->get('role') == 1 ? 'Enseignant' : 'Etudiant'; ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= base_url('profile'); ?>">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= base_url('profile'); ?>">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= base_url('login/logout') ?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  
  <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?= base_url('/dashboard'); ?>">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>

  <li class="nav-item">
    <a class="nav-link " href="<?= base_url('notes') ?> ">
    <i class="bi bi-grid"></i>
      <span>Notes</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('reclamations'); ?>">
        <i class="bi bi-grid"></i>
          <span>Réclamations</span>
        </a>
      </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?= base_url('profile'); ?>">
    <i class="bi bi-grid"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Profile Page Nav -->
  
</ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

<div class="pagetitle">
  <h1>Notes</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
       <li class="breadcrumb-item active">Notes</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Liste des notes</h5>
          
          <!-- Table with stripped rows -->
<!-- Table with stripped rows -->
<table class="table datatable">
  <thead>
    <tr>
      <th>Module</th>
      <th>Examen</th>
      <th>Note</th>
      <th>Commentaire</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($notes)): ?>
      <?php foreach ($notes as $note): ?>
        <tr>
          <td><?= esc($note['nomModule']) ?></td>
          <td><?= esc($note['libelleExamen']) ?></td>
          <td><?= esc($note['note']) ?></td>
          <td><?= esc($note['commentaire']) ?></td>
          <td>
            <!-- Button to open the modal -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reclamationModal" 
              data-module="<?= esc($note['nomModule']) ?>"
              data-examen="<?= esc($note['libelleExamen']) ?>"
              data-id="<?= esc($note['idEtudiant']) ?>">
                Soumettre une réclamation
            </button>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="5" class="text-center">Aucune note disponible.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>
<!-- End Table with stripped rows -->

<script>
    $(document).ready(function() {
        $('#reclamationModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Le bouton qui a déclenché l'ouverture du modal

            // Récupérer directement les valeurs des attributs data-*
            var module = button.data('module'); 
            var examen = button.data('examen');
            var idEtudiant = button.data('id');

            // Injecter les valeurs dans les champs du formulaire
            var modal = $(this);
            modal.find('#module').val(module);
            modal.find('#examen').val(examen);
            modal.find('#id_etudiant').val(idEtudiant);

            // DEBUG : Vérifier les valeurs dans la console
            console.log('Module:', module);
            console.log('Examen:', examen);
            console.log('ID étudiant:', idEtudiant);
        });
    });
</script>

<!-- Modal -->
<div class="modal fade" id="reclamationModal" tabindex="-1" aria-labelledby="reclamationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reclamationModalLabel">Soumettre une réclamation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="reclamationForm" action="<?= base_url('notes/submit') ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="module" id="module">
        <input type="hidden" name="examen" id="examen">
        <input type="hidden" name="id_etudiant" value="<?= session()->get('idEtudiant') ?>">

        <div class="mb-3">
          <label for="justification" class="form-label">Justification</label>
          <textarea class="form-control" id="justification" name="justification" rows="4" required></textarea>
        </div>

        <div class="mb-3">
          <label for="pieceJointe" class="form-label">Ajouter une pièce jointe</label>
          <input class="form-control" type="file" id="pieceJointe" name="pieceJointe">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Soumettre</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>


          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->


  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>My exams</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
<script src="<?= base_url('assets/vendor/apexcharts/apexcharts.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/chart.js/chart.umd.js') ?>"></script>
<script src="<?= base_url('assets/vendor/echarts/echarts.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/quill/quill.js') ?>"></script>
<script src="<?= base_url('assets/vendor/simple-datatables/simple-datatables.js') ?>"></script>
<script src="<?= base_url('assets/vendor/tinymce/tinymce.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/php-email-form/validate.js') ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/js/main.js') ?>"></script>



</body>

</html>