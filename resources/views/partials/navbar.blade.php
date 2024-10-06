<style>

.custom-navbar {
    background-color: #007bff; /* Warna biru */
}


</style>



<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts">Data Kesehatan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact">Contact</a>
            </li>
            <li class="nav-item">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger float-right" onclick="return confirm('Apakah Anda yakin ingin ingin keluar?')">Logout</button>
                    </form>
            </li>
        </ul>
    </div>
</nav>
