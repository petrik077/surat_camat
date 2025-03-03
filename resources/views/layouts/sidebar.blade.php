<div class="card" style="width: 150px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <div class="card-header" style="background-color: #007bff; color: white; font-weight: bold; border-top-left-radius: 10px; border-top-right-radius: 10px;">
        Menu
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item" style="border: none; padding: 10px 15px; background-color: #f8f9fa;">
            <a href="/dashboard" class="menu-link {{ Request::is('dashboard') ? 'active' : '' }}">Dashboard</a>
        </li>
        @if (Auth::user()->kasta === 'admin')
        <li class="list-group-item" style="border: none; padding: 10px 15px; background-color: #f8f9fa;">
            <a href="/jenissurat" class="menu-link {{ Request::is('jenissurat', 'jenissurat/*') ? 'active' : '' }}">Jenis Surat</a>
        </li>
        @endif
        <li class="list-group-item" style="border: none; padding: 10px 15px; background-color: #f8f9fa;">
            <a href="/suratmasuk" class="menu-link {{ Request::is('suratmasuk', 'suratmasuk/*') ? 'active' : '' }}">Surat Masuk</a>
        </li>
        <li class="list-group-item" style="border: none; padding: 10px 15px; background-color: #f8f9fa;">
            <a href="/surat" class="menu-link {{ Request::is('surat', 'surat/*') ? 'active' : '' }}">Surat Keluar</a>
        </li>
        @if (Auth::user()->kasta === 'admin')
        <li class="list-group-item" style="border: none; padding: 10px 15px; background-color: #f8f9fa;">
            <a href="/rekap" class="menu-link {{ Request::is('rekap') ? 'active' : '' }}">Rekap Surat Keluar</a>
        </li>
        @endif
    </ul>
</div>

<style>
    /* Menu Link Styles */
    .menu-link {
        text-decoration: none;
        color: #007bff;
        font-weight: 500;
        display: block;
        padding: 5px 0;
        transition: color 0.3s ease, background-color 0.3s ease;
    }

    /* Hover Effect for Menu Links */
    .menu-link:hover {
        color: #ffffff;
        background-color: #007bff;
    }

    /* Active State Styles */
    .menu-link.active {
        color: #ffffff;
        background-color: #007bff;
        font-weight: bold;
        border-radius: 5px;
    }

    /* Card Hover Effect */
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    /* Header Card Styles */
    .card-header {
        background-color: #007bff;
        color: white;
        font-size: 1.2rem;
        padding: 10px;
    }
</style>
