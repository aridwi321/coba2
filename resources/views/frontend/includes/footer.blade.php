<footer class="footer">
    <div class="container">
        <nav>
            <ul>
                <li>
                    <a href="/">
                        {{ config('app.name', 'Laravel Starter') }}
                    </a>
                </li>
                <li>
                    <a href="#">
                        About Us
                    </a>
                </li>
                @guest
                <li>
                    <a href="{{ route('register') }}">
                        Register
                    </a>
                </li>
                <li>
                    <a href="{{ route('login') }}">
                        Login
                    </a>
                </li>
                @else
                <li>
                    <a href="#">
                        {{ Auth::user()->name }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endguest
            </ul>
        </nav>
        <div class="copyright">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script> {{ config('app.name', 'Laravel Starter') }}, {!! setting('footer_text') !!}
        </div>
    </div>
</footer>
