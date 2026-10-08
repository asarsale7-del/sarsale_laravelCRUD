<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Carepoint') · Carepoint</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            color-scheme: light;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #1c2b28;
            background: #f4f7f5;
            font-synthesis: none;
        }
        * { box-sizing: border-box; }
        body { margin: 0; min-width: 320px; }
        a { color: inherit; text-decoration: none; }
        button, input, select, textarea { font: inherit; }
        .shell { min-height: 100vh; }
        .topbar { background: #fff; border-bottom: 1px solid #e4ebe7; }
        .topbar-inner, .main { width: min(1120px, calc(100% - 40px)); margin: 0 auto; }
        .topbar-inner { min-height: 72px; display: flex; align-items: center; justify-content: space-between; gap: 28px; }
        .brand { display: inline-flex; align-items: center; gap: 10px; color: #176c58; font-size: 19px; font-weight: 750; letter-spacing: -.03em; }
        .brand-mark { display: grid; width: 34px; height: 34px; place-items: center; border-radius: 11px; background: #e4f4ed; color: #176c58; font-size: 22px; }
        .nav { display: flex; align-items: center; gap: 8px; }
        .nav a { padding: 10px 14px; border-radius: 9px; color: #63716c; font-size: 14px; font-weight: 600; }
        .nav a:hover, .nav a.active { background: #eaf5ef; color: #176c58; }
        .main { padding: 42px 0 64px; }
        .page-heading { display: flex; align-items: flex-end; justify-content: space-between; gap: 20px; margin-bottom: 28px; }
        .eyebrow { margin: 0 0 8px; color: #548174; font-size: 12px; font-weight: 750; letter-spacing: .12em; text-transform: uppercase; }
        h1 { margin: 0; font-size: clamp(28px, 4vw, 36px); line-height: 1.15; letter-spacing: -.045em; }
        h2 { margin: 0; font-size: 19px; letter-spacing: -.025em; }
        .subtitle { margin: 9px 0 0; color: #77837e; font-size: 15px; }
        .button { display: inline-flex; min-height: 42px; align-items: center; justify-content: center; gap: 8px; border: 1px solid transparent; border-radius: 9px; padding: 0 15px; background: #176c58; color: #fff; cursor: pointer; font-size: 14px; font-weight: 700; }
        .button:hover { background: #105843; }
        .button-secondary { border-color: #d9e3de; background: #fff; color: #42534d; }
        .button-secondary:hover { background: #f7faf8; }
        .button-danger { border-color: #f2d5d1; background: #fff; color: #b84336; }
        .button-danger:hover { background: #fff5f3; }
        .button-small { min-height: 34px; padding: 0 11px; font-size: 13px; }
        .panel { overflow: hidden; border: 1px solid #e3ebe6; border-radius: 14px; background: #fff; box-shadow: 0 8px 24px rgb(25 57 45 / 3%); }
        .panel-heading { display: flex; align-items: center; justify-content: space-between; gap: 12px; border-bottom: 1px solid #edf1ee; padding: 19px 22px; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { background: #fbfcfb; color: #85918c; font-size: 11px; font-weight: 750; letter-spacing: .08em; text-transform: uppercase; }
        th, td { padding: 15px 22px; border-bottom: 1px solid #edf1ee; vertical-align: middle; }
        tr:last-child td { border-bottom: 0; }
        td { color: #53615c; font-size: 14px; }
        .primary-cell { color: #23352f; font-weight: 650; }
        .muted { color: #87938e; }
        .actions { display: flex; flex-wrap: wrap; align-items: center; gap: 7px; }
        .actions form { margin: 0; }
        .empty { padding: 52px 20px; text-align: center; }
        .empty p { margin: 8px 0 18px; color: #82908a; }
        .form-panel { max-width: 760px; padding: 26px; }
        .form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 19px; }
        .field { display: grid; gap: 8px; }
        .field-full { grid-column: 1 / -1; }
        label { color: #364841; font-size: 13px; font-weight: 700; }
        input, select, textarea { width: 100%; min-height: 43px; border: 1px solid #dce5e0; border-radius: 8px; padding: 10px 12px; background: #fff; color: #243630; outline: none; }
        textarea { min-height: 108px; resize: vertical; }
        input:focus, select:focus, textarea:focus { border-color: #4b9a80; box-shadow: 0 0 0 3px rgb(75 154 128 / 14%); }
        .field-error { margin: 0; color: #b84336; font-size: 12px; }
        .form-actions { display: flex; gap: 9px; margin-top: 24px; }
        .alert { margin-bottom: 22px; border: 1px solid #b9e5cf; border-radius: 10px; padding: 13px 16px; background: #edfaf2; color: #236849; font-size: 14px; }
        .detail-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0; }
        .detail { padding: 18px 22px; border-bottom: 1px solid #edf1ee; }
        .detail-label { display: block; margin-bottom: 7px; color: #87938e; font-size: 11px; font-weight: 750; letter-spacing: .08em; text-transform: uppercase; }
        .detail-value { color: #2a3d36; font-size: 15px; overflow-wrap: anywhere; }
        .badge { display: inline-flex; border-radius: 99px; padding: 5px 10px; background: #edf5f1; color: #3e715f; font-size: 12px; font-weight: 700; text-transform: capitalize; }
        .status-completed { background: #e9f6eb; color: #347149; }
        .status-cancelled { background: #fff0ee; color: #ae473b; }
        .cards { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; margin-bottom: 24px; }
        .stat-card { padding: 22px; }
        .stat-label { color: #7b8983; font-size: 13px; font-weight: 650; }
        .stat-value { margin-top: 8px; color: #1b6a55; font-size: 34px; font-weight: 750; letter-spacing: -.05em; }
        .pagination { padding: 18px 22px; }
        @media (max-width: 680px) {
            .topbar-inner { width: calc(100% - 28px); min-height: 64px; gap: 12px; }
            .brand { font-size: 16px; }
            .nav { gap: 0; }
            .nav a { padding: 9px 8px; font-size: 12px; }
            .main { width: calc(100% - 28px); padding-top: 30px; }
            .page-heading { align-items: flex-start; flex-direction: column; }
            .form-grid, .detail-grid, .cards { grid-template-columns: 1fr; }
            .form-panel { padding: 20px; }
            th, td { padding: 13px 15px; }
        }
    </style>
</head>
<body>
<div class="shell">
    <header class="topbar">
        <div class="topbar-inner">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark">+</span>
                <span>Carepoint</span>
            </a>
            <nav class="nav" aria-label="Main navigation">
                <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Overview</a>
                <a class="{{ request()->routeIs('appointments.*') ? 'active' : '' }}" href="{{ route('appointments.index') }}">Appointments</a>
                <a class="{{ request()->routeIs('patients.*') ? 'active' : '' }}" href="{{ route('patients.index') }}">Patients</a>
            </nav>
        </div>
    </header>
    <main class="main">
        @if (session('success'))
            <div class="alert" role="status">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
</div>
</body>
</html>
