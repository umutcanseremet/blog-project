<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>Admin Kayıt Formu</title>
  </head>
  <body>
    <nav class="navbar navbar-light navbar-expand-lg mb-5">
    <a class="navbar-brand" href="#">Admin Menüsü</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        @guest
        <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>

        @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin_save') }}">Yeni Admin Ekle</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('topic_page')}}">Yeni Yazı Ekle</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{route('articles_page_page')}}">Eklediğim Yazılar</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ route('signout') }}" style="color:red;">Çıkış Yap</a>
                </li>
        @endguest
    </div>
  </nav>
  @yield('content')
    <div class="container">
      <div class="row">
        <div class="col-md-4.col-md-offset-4">
          <h4>Admin Kayıt Formu</h4>
          <hr></hr>
          <form action="{{route('admin_save')}}" method="post">
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            @csrf
            <div class="form-group">
              <label for="name">İsim</label>
              <input type="text" class="form-control" placeholder="İsminizi Giriniz" name="name" value="{{old('email')}}" required>
              <!-- <span class="text-danger">@error('name'){{$message}}@endif</span> -->
            </div>
            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" class="form-control" placeholder="E-mail Giriniz" name="email" value="" required>
            </div>
            <div class="form-group">
              <label for="password">Şifre</label>
              <input type="password" class="form-control" placeholder="Şifrenizi Giriniz" name="password" value="" required>
            </div>
            <div class="form-group">
              <button class="btn btn-block btn-primary" type="submit">Kayıt</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
