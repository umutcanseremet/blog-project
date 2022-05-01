<!DOCTYPE html>
<html>
<head>
<title>Admin Sayfası</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;"
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
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
