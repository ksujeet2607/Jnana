<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='50' fill='%232563eb'/%3E%3Ctext y='72' x='50' font-family='sans-serif' font-weight='800' font-size='65' fill='%23ffffff' text-anchor='middle'%3Ee%3C/text%3E%3C/svg%3E">
    <?php csrf_meta(); ?>
    <script
            src="<?= public_path('js/jnana-security.js') ?>"
            defer
    ></script>
    <title>Welcome to Easy Framework</title>
    <style>
        :root {
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --primary: #2563eb;
            --primary-light: #eff6ff;
            --success: #10b981;
            --border: #e2e8f0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            line-height: 1.6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 650px;
            width: 100%;
            padding: 2rem;
            box-sizing: border-box;
        }

        .header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--primary);
            margin: 0;
            letter-spacing: -0.05em;
        }

        .tagline {
            font-size: 1.2rem;
            color: var(--text-muted);
            margin: 0.5rem 0 0 0;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--primary-light);
            color: var(--primary);
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .status-badge .dot {
            width: 8px;
            height: 8px;
            background-color: var(--success);
            border-radius: 50%;
        }

        h2 {
            font-size: 1.25rem;
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .steps {
            list-style: none;
            padding: 0;
            margin: 0 0 2rem 0;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border);
        }

        .step-item:last-child {
            border-bottom: none;
        }

        .step-number {
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 700;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 0.875rem;
        }

        .step-content code {
            background: #f1f5f9;
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-family: monospace;
            font-size: 0.9rem;
            color: #0f172a;
        }

        .footer {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .footer a {
            color: var(--primary);
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1 class="logo">Jnana.</h1>
        <p class="tagline">The lightweight, no-nonsense PHP framework.</p>
    </div>

    <div class="card">
        <div class="status-badge">
            <span class="dot"></span>
            Easy is successfully installed! (PHP v<?php echo phpversion(); ?>)
        </div>

        <h2>Getting Started</h2>
        <ul class="steps">
            <li class="step-item">
                <span class="step-number">1</span>
                <div class="step-content">
                    <strong>Define your first route</strong>
                    <p style="margin: 0.25rem 0 0 0; color: var(--text-muted);">Open <code>app/routes.php</code> and map a URL to a closure or a controller.</p>
                </div>
            </li>
            <li class="step-item">
                <span class="step-number">2</span>
                <div class="step-content">
                    <strong>Create a view</strong>
                    <p style="margin: 0.25rem 0 0 0; color: var(--text-muted);">This template is rendered from <code>app/views/welcome.php</code>. Customize it to fit your app.</p>
                </div>
            </li>
            <li class="step-item">
                <span class="step-number">3</span>
                <div class="step-content">
                    <strong>Configure environment variables</strong>
                    <p style="margin: 0.25rem 0 0 0; color: var(--text-muted);">Duplicate <code>.env.example</code> to <code>.env</code> to set up your database connection details.</p>
                </div>
            </li>
        </ul>
    </div>

    <div class="footer">
        <p>Built with simplicity. | <a href="https://raw.githubusercontent.com/ksujeet2607/Jnana/refs/heads/main/README.md">Documentation</a> &bull; <a href="https://github.com/ksujeet2607/Jnana">GitHub</a></p>
    </div>
</div>

</body>
</html>