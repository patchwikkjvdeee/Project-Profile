<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Hey, it's us</title>
    <style>
        :root {
            --ink: #f4f4f5;
            --muted: #9f9fa9;
            --bg: #121214;
            --card: #1c1c1f;
            --card-hover: #222225;
            --accent: #e4e4e7;
            --line: #2d2d31;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 15% 0%, rgba(255,255,255,.04), transparent 45%),
                var(--bg);
            line-height: 1.6;
        }
        .mono { font-family: "SFMono-Regular", Consolas, "Courier New", monospace; }

        nav {
            display: flex; flex-wrap: wrap; gap: .75rem; justify-content: space-between; align-items: center;
            padding: 1.1rem 2rem;
            background: rgba(28, 28, 31, .85);
            backdrop-filter: blur(6px);
            border-bottom: 1px solid var(--line);
            position: sticky; top: 0; z-index: 10;
        }
        nav .brand { font-weight: 700; font-size: 1.05rem; color: var(--ink); text-decoration: none; letter-spacing: -.01em; }
        nav .links a { margin-left: 1.5rem; color: var(--muted); text-decoration: none; font-weight: 500; font-family: "SFMono-Regular", Consolas, "Courier New", monospace; font-size: .85rem; letter-spacing: .02em; transition: color .15s ease; }
        nav .links a:hover, nav .links a:focus-visible { color: var(--ink); }

        main { max-width: 640px; margin: 2.5rem auto; padding: 0 1.25rem; }
        h1 { margin: .5rem 0 1rem; font-size: 2.1rem; line-height: 1.2; letter-spacing: -.02em; }
        h2 { margin: 2.25rem 0 .75rem; font-size: .78rem; text-transform: uppercase; letter-spacing: .1em; color: var(--muted); font-weight: 600; }
        a { color: var(--ink); text-decoration-color: var(--line); text-underline-offset: 2px; }

        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 1.35rem 1.5rem;
            margin-bottom: 1rem;
        }
        .row { display: flex; justify-content: space-between; gap: 1rem; padding: .65rem 0; border-bottom: 1px solid var(--line); font-family: "SFMono-Regular", Consolas, "Courier New", monospace; font-size: .88rem; }
        .row:last-child { border-bottom: 0; }
        .row span:first-child { color: var(--muted); }

        .item {
            display: flex; justify-content: space-between; align-items: center;
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-bottom: .7rem;
            transition: background .15s ease, border-color .15s ease;
        }
        .item:hover { background: var(--card-hover); border-color: #3a3a40; }
        .item a { font-weight: 600; text-decoration: none; }
        .item span { color: var(--muted); font-family: "SFMono-Regular", Consolas, "Courier New", monospace; font-size: .82rem; }

        .tag {
            display: inline-block; background: var(--bg); color: var(--ink);
            border: 1px solid var(--line); padding: .3rem .85rem; border-radius: 999px;
            margin: 0 .4rem .5rem 0; font-family: "SFMono-Regular", Consolas, "Courier New", monospace; font-size: .8rem;
        }

        .avatar {
            width: 68px; height: 68px; border-radius: 14px;
            background: linear-gradient(145deg, #e4e4e7, #c7c7cc);
            color: var(--bg);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.7rem; font-weight: 700; margin-bottom: 1.1rem;
            font-family: "SFMono-Regular", Consolas, "Courier New", monospace;
        }
        .tagline { color: var(--muted); font-size: 1.05rem; margin-top: -.5rem; }

        .btn, button {
            display: inline-block; padding: .65rem 1.25rem;
            background: var(--accent); color: var(--bg);
            border: 0; border-radius: 8px; font-size: .88rem; font-weight: 600;
            text-decoration: none; cursor: pointer; font-family: "SFMono-Regular", Consolas, "Courier New", monospace;
            transition: opacity .15s ease, transform .1s ease;
        }
        .btn:hover, button:hover { opacity: .88; }
        .btn:active, button:active { transform: scale(.98); }
        .btn:focus-visible, button:focus-visible, input:focus-visible, textarea:focus-visible { outline: 2px solid var(--muted); outline-offset: 2px; }
        .btn-ghost { background: transparent; color: var(--ink); border: 1px solid var(--line); }
        .btn-ghost:hover { background: var(--card-hover); opacity: 1; }
        .btn-danger { background: #2a1516; color: #f3a2a2; border: 1px solid #4a2324; }
        .actions { margin-top: 1.1rem; display: flex; flex-wrap: wrap; gap: .6rem; }

        label { display: block; margin: 1.15rem 0 .35rem; font-weight: 600; font-size: .8rem; color: var(--muted); font-family: "SFMono-Regular", Consolas, "Courier New", monospace; letter-spacing: .02em; }
        input, textarea {
            width: 100%; padding: .65rem .8rem;
            border: 1px solid var(--line); border-radius: 8px;
            font-size: .93rem; font-family: "SFMono-Regular", Consolas, "Courier New", monospace;
            background: var(--bg); color: var(--ink);
            transition: border-color .15s ease;
        }
        input:focus, textarea:focus { border-color: var(--muted); }
        input::placeholder, textarea::placeholder { color: #5c5c63; }
        .error { color: #f3a2a2; font-size: .82rem; margin-top: .3rem; font-family: "SFMono-Regular", Consolas, "Courier New", monospace; }
        .empty { background: var(--card); border: 1px dashed var(--line); padding: 1.75rem; border-radius: 10px; text-align: center; color: var(--muted); }

        footer { text-align: center; color: var(--muted); padding: 2.5rem 0 1.5rem; font-size: .78rem; font-family: "SFMono-Regular", Consolas, "Courier New", monospace; opacity: .7; }
    </style>
</head>
<body>
    <nav>
        <a class="brand" href="/">Profiles</a>
        <div class="links">
            <a href="/">profiles</a>
            <a href="/about">about</a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>&copy; No Name 2026 </footer>
</body>
</html>