<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            My First Laravel App
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>

            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/hardwares">Hardwares</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/computers/tested">My Test Result</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/computers">Admin page</a>
                </li>
            </ul>
            <ul>
                <form action="{{ route('search') }}" method="GET" class="search-form">
                    <input type="text" name="query" id="query" class="search-box" placeholder="Search for product" value="{{ request()->input('query') }}">
                </form>
            </ul>
        </div>
    </div>
</nav>
