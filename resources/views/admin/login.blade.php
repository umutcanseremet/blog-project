<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
<!-- Google Fonts -->
<link  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"
/>
<!-- MDB -->
<link  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet"
/>
<!-- MDB -->
<script  type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
  </head>
  <style>
  @import '~mdb-ui-kit/css/mdb.min.css';
  .divider:after,
  .divider:before {
  content: "";
  flex: 1;
  height: 1px;
  background: #eee;
  }
  </style>
  <body>
    <section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
          class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        @if($errors->any())
        <div class="alert alert-danger">
          {{$errors->first()}}
        </div>
        @endif
                        <div class="card">
                            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('auth') }}">
          @csrf
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="text" name="email" id="form1Example13" class="form-control form-control-lg" />
            <label class="form-label" for="form1Example13">Email Adresi</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="password" name="password" id="form1Example23" class="form-control form-control-lg" />
            <label class="form-label" for="form1Example23">Şifre</label>
          </div>

          <div class="d-flex justify-content-around align-items-center mb-4">
            <a href="{{route('index')}}">Ana Sayfaya Dön</a>
          </div>

          <!-- Submit button -->
          <button type="submit" class="btn btn-primary btn-lg btn-block">Giriş Yap</button>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0 text-muted">Beni Takip Edebilirsiniz</p>
          </div>

          <a class="btn btn-primary btn-lg btn-block" style="background-color: #9B59B6 " href="#!"
            role="button">

            <i class="fa-brands fa-github me-2"></i></i>Github Hesabım
          </a>
          <a class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="#!"
            role="button">
              <i class="fab fa-linkedin me-2"></i>
            </i>Linkledin Hesabım </a>

        </form>
      </div>
    </div>
  </div>
</section>
  </body>
</html>
