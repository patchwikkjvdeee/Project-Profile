<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | My Profile</title>
    <style>
        :root {
            --ink: #1e293b;
            --muted: #64748b;
            --bg: #f1f5f9;
            --card: #ffffff;
            --accent: #4f46e5;
            --line: #e2e8f0;
        }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: system-ui, -apple-system, "Segoe UI", sans-serif; color: var(--ink); background: var(--bg); line-height: 1.6; }

        nav { display: flex; flex-wrap: wrap; gap: .75rem; justify-content: space-between; align-items: center; padding: 1rem 2rem; background: var(--card); border-bottom: 1px solid var(--line); }
        nav .left { display: flex; align-items: center; gap: .9rem; }
        nav .brand { font-weight: 700; font-size: 1.1rem; color: var(--ink); text-decoration: none; }
        nav .links a { margin-left: 1.25rem; color: var(--muted); text-decoration: none; font-weight: 500; }
        nav .links a:hover, nav .links a:focus-visible { color: var(--accent); }
        nav .back { padding: .35rem .9rem; font-size: .9rem; }

        main { max-width: 620px; margin: 2rem auto; padding: 0 1.25rem; }
        h1 { margin: .5rem 0 1rem; font-size: 2rem; line-height: 1.2; }
        h2 { margin-top: 2rem; }
        a { color: var(--accent); }

        .card { background: var(--card); border: 1px solid var(--line); border-radius: 12px; padding: 1.25rem 1.5rem; margin-bottom: 1rem; box-shadow: 0 1px 2px rgba(15, 23, 42, .05); }
        .row { display: flex; justify-content: space-between; gap: 1rem; padding: .6rem 0; border-bottom: 1px solid var(--line); }
        .row:last-child { border-bottom: 0; }
        .row span:first-child { color: var(--muted); }

        .tag { display: inline-block; background: #eef2ff; color: var(--accent); padding: .25rem .9rem; border-radius: 999px; margin: 0 .4rem .5rem 0; font-weight: 500; }

        .avatar { width: 84px; height: 84px; border-radius: 50%; background: var(--accent); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 2.2rem; font-weight: 700; margin-bottom: 1rem; }
        .tagline { color: var(--muted); font-size: 1.15rem; margin-top: -.5rem; }

        .btn, button { display: inline-block; padding: .65rem 1.3rem; background: var(--accent); color: #fff; border: 0; border-radius: 8px; font-size: 1rem; font-weight: 600; text-decoration: none; cursor: pointer; font-family: inherit; }
        .btn:hover, button:hover { opacity: .9; }
        .btn:focus-visible, button:focus-visible, input:focus-visible, textarea:focus-visible { outline: 3px solid #c7d2fe; outline-offset: 2px; }
        .btn-ghost { background: var(--card); color: var(--ink); border: 1px solid var(--line); }
        .btn-danger { background: #dc2626; }
        .actions { margin-top: 1rem; display: flex; flex-wrap: wrap; gap: .6rem; }

        label { display: block; margin: 1.1rem 0 .3rem; font-weight: 600; }
        input, textarea { width: 100%; padding: .65rem .8rem; border: 1px solid var(--line); border-radius: 8px; font-size: 1rem; font-family: inherit; background: var(--card); color: var(--ink); }
        .error { color: #dc2626; font-size: .9rem; margin-top: .25rem; }

        footer { text-align: center; color: var(--muted); padding: 2rem 0; font-size: .9rem; }
    </style>
</head>
<body>
    <nav>
        <div class="left">
            <a class="brand" href="/">👋 My Profile</a>

            @hasSection('back')
                <a class="btn btn-ghost back" href="/">&larr; Back</a>
            @endif
        </div>

        <div class="links">
            <a href="/">Home</a>
            <a href="/skills">Skills</a>
            <a href="/contact">Contact</a>
            <a href="/edit">Edit</a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

</body>
</html>