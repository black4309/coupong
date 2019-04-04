<br/>
<img src="/source/images/logo.png"/>
<br/>
<span style="float:right">
  {{Session::get('session_username')}} 님 <a href="/logout">로그아웃</a>
</span>

<br/>



<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">

@if(Session::get('session_userid') == "admin")

      <li class="nav-item active">
        <a class="nav-link" href="/publish">쿠폰 발행</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="/list">쿠폰 리스트</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="/stat">쿠폰 통계</a>
      </li>

@else

      <li class="nav-item active">
          <a class="nav-link" href="/use">쿠폰 사용</a>
      </li>

@endif

    </ul>
  </div>
</nav>

<br/>
