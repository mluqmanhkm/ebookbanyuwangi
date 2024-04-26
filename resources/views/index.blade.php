<h1>halaman pembaca</h1>
<a href="">home</a>
    @guest
    <a href="{{ route('login') }}">login</a>
    <a href="">register</a>  
    @endguest

    @auth
    <p>Selamat datang, {{ auth()->user()->nama }},</p>
    @if(auth()->user()->role == 3)
    <p class="card-subtitle text-body-secondary">pembaca</p>
    @endif
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form> 
    @endauth

