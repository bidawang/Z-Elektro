<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name') }}</title>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Vendor --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- ALPINE JS --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --bg: #f1f5f9;
            --surface: #ffffff;
            --border: #e5e7eb;
            --text: #1e293b;
            --muted: #64748b;
            --primary: #6366f1;
            --shadow-soft: 0 6px 20px rgba(0, 0, 0, .05);
        }

        body {
            background: var(--bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text);
            padding-bottom: 110px;
            font-size: .85rem;
        }

        /* ===== HEADER ===== */

        .app-header {
            position: sticky;
            top: 0;
            z-index: 1055;
            background: rgba(255, 255, 255, .85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
        }

        .app-title {
            padding: 14px;
            font-weight: 800;
            text-align: center;
            letter-spacing: .12em;
            text-transform: uppercase;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .filter-bar {
            padding: 10px 16px 14px;
        }

        /* ===== KATALOG CARD ===== */

        .katalog-card {
            border-radius: 20px;
            transition: all .25s ease;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .06);
        }

        .katalog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 30px rgba(0, 0, 0, .08);
        }

        .katalog-card .btn {
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .03em;
        }

        /* ===== CONTENT ===== */

        main {
            padding-top: 14px;
        }

        /* ===== CARD ===== */

        .card {
            border: none;
            border-radius: 18px;
            box-shadow: var(--shadow-soft);
        }

        /* ===== DROPDOWN SAFE ===== */

        .dropdown-menu {
            z-index: 1060;
        }

        /* ===== BOTTOM NAV ===== */

        .bottom-nav {
            position: fixed;
            bottom: 14px;
            left: 14px;
            right: 14px;
            background: #0f172a;
            border-radius: 22px;
            padding: 8px;
            display: flex;
            z-index: 1060;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .3);
        }

        .nav-item-box {
            flex: 1;
            text-align: center;
            text-decoration: none;
            color: #94a3b8;
            font-size: .65rem;
            font-weight: 600;
        }

        .nav-item-box span {
            display: block;
            font-size: 1.3rem;
            margin-bottom: 2px;
        }

        .nav-item-box.active {
            color: #fff;
        }

        .btn-logout {
            background: none;
            border: none;
            color: #fb7185;
            width: 100%;
            padding: 0;
        }

        /* ===== FOOTER ===== */

        .footer-public {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 14px;
            text-align: center;
            font-size: .7rem;
            color: var(--muted);
        }

        .app-footer {
            margin-top: 40px;
            padding: 24px 10px 90px;
            text-align: center;
            color: var(--muted);
            font-size: .72rem;
        }

        .footer-title {
            font-weight: 700;
            letter-spacing: .08em;
            font-size: .8rem;
            margin-bottom: 4px;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .footer-sub {
            opacity: .8;
            margin-bottom: 6px;
        }

        .footer-meta {
            opacity: .6;
        }
    </style>

    @stack('styles')

</head>

<body>

    {{-- HEADER --}}
    <div class="app-header">
        <div class="app-title">
            {{ config('app.name') }}
        </div>

        @yield('header-filter')
    </div>

    {{-- CONTENT --}}
    <main class="container">
        @yield('content')
    </main>

    {{-- NAV --}}
    @auth

        <div class="bottom-nav">

            {{-- KATALOG (admin & developer) --}}
            @if (in_array(auth()->user()->level, ['developer', 'admin','kasir']))
                <a href="{{ route('katalog.index') }}" class="nav-item-box {{ request()->is('/') ? 'active' : '' }}">
                    <span>🏠</span>
                    Katalog
                </a>
            @endif


            {{-- BARANG (admin & developer) --}}
            @if (in_array(auth()->user()->level, ['developer', 'admin', 'kasir']))
                <a href="{{ route('barang.index') }}"
                    class="nav-item-box {{ request()->is('admin/barang*') ? 'active' : '' }}">
                    <span>📦</span>
                    Barang
                </a>
            @endif


            {{-- KATEGORI (admin & developer) --}}
            @if (in_array(auth()->user()->level, ['developer', 'admin']))
                <a href="{{ route('kategori.index') }}"
                    class="nav-item-box {{ request()->is('kategori*') ? 'active' : '' }}">
                    <span>📂</span>
                    Kategori
                </a>
            @endif


            {{-- LAPORAN (semua user login) --}}
            <a href="{{ route('laporan.index') }}" class="nav-item-box {{ request()->is('laporan*') ? 'active' : '' }}">
                <span>📝</span>
                Laporan
            </a>


            {{-- LOGOUT --}}
            <form action="{{ route('logout') }}" method="POST" class="nav-item-box">
                @csrf
                <button type="submit" class="btn-logout">
                    <span>🚪</span>
                    Logout
                </button>
            </form>

        </div>
    @else
        <footer class="app-footer">
            <div class="container text-center">

                <div class="footer-title">
                    {{ config('app.name') }}
                </div>

                <div class="footer-sub">
                    Sistem Laporan Operasional
                </div>

                <div class="footer-meta">
                    © {{ date('Y') }} • All Rights Reserved
                </div>

            </div>
        </footer>

    @endauth


    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>

</html>
