<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Favicon icon-->
   <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon/favicon.ico">

   <!-- Libs CSS -->
   <link href="../assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
   <link href="../assets/libs/dropzone/dist/dropzone.css" rel="stylesheet">
   <link href="../assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" />
   <link href="../assets/libs/prismjs/themes/prism-okaidia.css" rel="stylesheet">

   <!-- Theme CSS -->
   <link rel="stylesheet" href="../assets/css/theme.min.css">
   <title>Sign In</title>
</head>

<body class="bg-light">
   <!-- container -->
   <div class="container d-flex flex-column">
      <div class="row align-items-center justify-content-center g-0
        min-vh-100">
         <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
            <!-- Card -->
            <div class="card smooth-shadow-md">
               <!-- Card body -->
               <div class="card-body p-6">
                  <div class="mb-4">
                     <a href=""><img src="../assets/images/brand/logo/logo-primary.svg" class="mb-2" alt=""></a>
                     <p class="mb-6">Please enter your user information.</p>
                  </div>
                  @if (session()->has('loginError'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     <strong>{{ session('loginError') }}</strong>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif
                  <!-- Form -->
                  <form action="/login" method="post">
                     @csrf
                     <!-- Username -->
                     <div class="mb-2">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" name="username" autofocus required value="{{ old('username') }}">
                        @error('username')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                        @enderror
                     </div>
                     <!-- Password -->
                     <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control  @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                        @enderror
                     </div>
                     <!-- Checkbox -->
                     <div class="d-lg-flex justify-content-between align-items-center
                  mb-4">
                        <!-- <div class="form-check custom-checkbox">
                           <input type="checkbox" class="form-check-input" id="rememberme">
                           <label class="form-check-label" for="rememberme">Remember
                              me</label>
                        </div> -->
                     </div>
                     <div>
                        <!-- Button -->
                        <div class="d-grid">
                           <button type="submit" class="btn btn-primary">Sign
                              in</button>
                        </div>

                        <div class="d-md-flex justify-content-between mt-4">
                           <div class="mb-2 mb-md-0">
                              <a href="/register" class="fs-5">Create An
                                 Account </a>
                           </div>
                           <!-- <div>
                              <a href="forget-password.html" class="text-inherit
                        fs-5">Forgot
                                 your password?</a>
                           </div> -->

                        </div>
                     </div>


                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Scripts -->
   <!-- Libs JS -->
   <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
   <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   <script src="../assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>
   <script src="../assets/libs/feather-icons/dist/feather.min.js"></script>
   <script src="../assets/libs/prismjs/prism.js"></script>
   <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
   <script src="../assets/libs/dropzone/dist/min/dropzone.min.js"></script>
   <script src="../assets/libs/prismjs/plugins/toolbar/prism-toolbar.min.js"></script>
   <script src="../assets/libs/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>

   <!-- Theme JS -->
   <script src="../assets/js/theme.min.js"></script>
</body>

</html>