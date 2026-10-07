<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Profile</title>
    <style>
        :root {
            --bg: #0e0e10;
            --panel: #17171a;
            --panel-2: #1e1e22;
            --line: #2a2a30;
            --line-strong: #3b3b43;
            --ink: #ececef;
            --muted: #8e8e98;
            --accent: #b4bcc9;
            --accent-ink: #0e0e10;
            --danger-bg: #261516;
            --danger-ink: #f1a3a3;
            --danger-line: #472324;
            --mono: "SFMono-Regular", Consolas, "Courier New", monospace;
        }
        * { box-sizing: border-box; }

        body {
            margin: 0;
            color: var(--ink);
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            line-height: 1.6;
            background-color: var(--bg);
            background-image:
                linear-gradient(var(--line) 1px, transparent 1px),
                linear-gradient(90deg, var(--line) 1px, transparent 1px);
            background-size: 48px 48px;
            background-position: -1px -1px;
            min-height: 100vh;
        }
        body::before {
            content: "";
            position: fixed; inset: 0; z-index: -1;
            background: radial-gradient(ellipse at 50% 0%, rgba(14,14,16,.2), var(--bg) 75%);
        }

        nav {
            position: sticky; top: 0; z-index: 10;
            display: flex; flex-wrap: wrap; gap: .75rem;
            justify-content: space-between; align-items: center;
            padding: .85rem 2rem;
            background: rgba(23, 23, 26, .92);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--line-strong);
            border-radius: 0;
        }
        nav .brand {
            font-weight: 700; font-size: 1rem;
            color: var(--ink); text-decoration: none; letter-spacing: -.01em;
        }
        nav .links a {
            margin-left: .25rem; padding: .35rem .85rem;
            color: var(--muted); text-decoration: none;
            font-family: var(--mono); font-size: .8rem;
            border-radius: 0;
            border-bottom: 2px solid transparent;
            transition: color .15s ease, border-color .15s ease;
        }
        nav .links a:hover, nav .links a:focus-visible {
            color: var(--ink); border-bottom-color: var(--accent);
        }

        main { max-width: 680px; margin: 2.5rem auto; padding: 0 1.25rem; }
        h1 { margin: .4rem 0 1.1rem; font-size: 2.2rem; line-height: 1.15; letter-spacing: -.025em; }
        h2 {
            margin: 2.25rem 0 .7rem; padding-left: .7rem;
            border-left: 3px solid var(--accent);
            font-family: var(--mono); font-size: .75rem;
            text-transform: uppercase; letter-spacing: .12em;
            color: var(--muted); font-weight: 600;
        }
        a { color: var(--ink); text-decoration-color: var(--line-strong); text-underline-offset: 3px; }
        a:hover { text-decoration-color: var(--accent); }
        p { margin: 0 0 .75rem; }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 1.3rem 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .25);
        }
        .row {
            display: flex; justify-content: space-between; gap: 1rem;
            padding: .65rem 0; border-bottom: 1px dashed var(--line);
            font-family: var(--mono); font-size: .86rem;
        }
        .row:last-child { border-bottom: 0; }
        .row span:first-child { color: var(--muted); }

        .item {
            display: flex; justify-content: space-between; align-items: center; gap: 1rem;
            background: var(--panel);
            border: 1px solid var(--line);
            border-left: 3px solid var(--line-strong);
            border-radius: 10px;
            padding: 1rem 1.25rem; margin-bottom: .7rem;
            transition: background .15s ease, border-color .15s ease, transform .15s ease;
        }
        .item:hover { background: var(--panel-2); border-left-color: var(--accent); transform: translateX(3px); }
        .item a { font-weight: 600; text-decoration: none; }
        .item span { color: var(--muted); font-family: var(--mono); font-size: .8rem; text-align: right; }

        .tag {
            display: inline-block; margin: 0 .4rem .5rem 0; padding: .28rem .8rem;
            background: var(--panel-2); color: var(--ink);
            border: 1px solid var(--line-strong); border-radius: 6px;
            font-family: var(--mono); font-size: .78rem;
        }
        .avatar {
            width: 72px; height: 72px; margin-bottom: 1.1rem;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(145deg, #d6dae1, #8f97a5);
            color: var(--accent-ink);
            border-radius: 16px; border: 1px solid var(--line-strong);
            font-family: var(--mono); font-size: 1.8rem; font-weight: 700;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .35);
        }
        .tagline { color: var(--muted); font-size: 1.05rem; margin-top: -.5rem; }

        .btn, button {
            display: inline-block; padding: .62rem 1.2rem;
            background: var(--accent); color: var(--accent-ink);
            border: 1px solid transparent; border-radius: 8px;
            font-family: var(--mono); font-size: .82rem; font-weight: 600;
            text-decoration: none; cursor: pointer;
            transition: opacity .15s ease, transform .1s ease, background .15s ease;
        }
        .btn:hover, button:hover { opacity: .88; }
        .btn:active, button:active { transform: scale(.97); }
        .btn:focus-visible, button:focus-visible, input:focus-visible, textarea:focus-visible {
            outline: 2px solid var(--accent); outline-offset: 2px;
        }
        .btn-ghost { background: transparent; color: var(--ink); border-color: var(--line-strong); }
        .btn-ghost:hover { background: var(--panel-2); opacity: 1; }
        .btn-danger { background: var(--danger-bg); color: var(--danger-ink); border-color: var(--danger-line); }
        .actions { margin-top: 1.1rem; display: flex; flex-wrap: wrap; gap: .6rem; }

        label {
            display: block; margin: 1.15rem 0 .35rem;
            font-family: var(--mono); font-size: .75rem; font-weight: 600;
            letter-spacing: .06em; text-transform: uppercase; color: var(--muted);
        }
        input, textarea {
            width: 100%; padding: .65rem .85rem;
            background: var(--bg); color: var(--ink);
            border: 1px solid var(--line-strong); border-radius: 8px;
            font-family: var(--mono); font-size: .9rem;
            transition: border-color .15s ease;
        }
        input:focus, textarea:focus { border-color: var(--accent); outline: none; }
        input::placeholder, textarea::placeholder { color: #565660; }
        .error { margin-top: .3rem; color: var(--danger-ink); font-family: var(--mono); font-size: .8rem; }
        .empty {
            padding: 1.75rem; text-align: center; color: var(--muted);
            background: var(--panel); border: 1px dashed var(--line-strong); border-radius: 12px;
        }

        footer {
            text-align: center; color: var(--muted); opacity: .7;
            padding: 2.5rem 0 1.75rem; font-family: var(--mono); font-size: .75rem;
        }

        @media (max-width: 520px) {
            nav { padding: .75rem 1rem; }
            h1 { font-size: 1.8rem; }
        }
    </style>
</head>
<body>
    <nav>
        <a class="brand" href="/">Profile</a>
        <div class="links">
            <a href="/">Profiles</a>
            <a href="/about">About</a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>&copy; 2026 No Name</footer>
</body>
</html>
