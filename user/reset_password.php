<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | MR. VIKING</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" type="image/png" href="../images/Mr. Viking.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: var(--color-bg-primary);
            font-family: var(--font-primary);
        }
        .reset-card {
            background: var(--color-bg-secondary);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            text-align: center;
        }
        .reset-card .logo-area {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 30px;
        }
        .reset-card .logo-area img { height: 35px; }
        .reset-card .logo-area span { font-size: 1.2rem; font-weight: 800; letter-spacing: 0.2em; color: var(--color-white); text-transform: uppercase; }
        .reset-card h2 { color: var(--color-white); font-size: 1.5rem; margin-bottom: 8px; }
        .reset-card p { color: var(--color-text-secondary); font-size: 0.9rem; margin-bottom: 25px; }
        .reset-input {
            width: 100%;
            padding: 14px 18px;
            background: var(--color-bg-tertiary);
            border: 1px solid var(--color-border);
            border-radius: 8px;
            color: var(--color-white);
            font-size: 1rem;
            margin-bottom: 15px;
            box-sizing: border-box;
        }
        .reset-input:focus { outline: none; border-color: var(--color-accent); }
        .reset-btn {
            width: 100%;
            padding: 14px;
            background: var(--color-accent);
            color: white;
            border: none;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.95rem;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
        }
        .reset-btn:hover { opacity: 0.9; transform: translateY(-1px); }
        .reset-btn:disabled { opacity: 0.5; cursor: not-allowed; }
        .msg { padding: 12px; border-radius: 8px; margin-bottom: 15px; font-size: 0.9rem; display: none; }
        .msg.success { background: rgba(34,197,94,0.15); color: #22c55e; display: block; }
        .msg.error { background: rgba(239,68,68,0.15); color: #ef4444; display: block; }
        .back-link { margin-top: 20px; display: inline-block; color: var(--color-accent); font-size: 0.85rem; }
    </style>
</head>
<body>
    <div class="reset-card">
        <div class="logo-area">
            <img src="../images/Mr. Viking.png" alt="MR. VIKING Logo">
            <span>MR. VIKING</span>
        </div>
        <h2>Reset Your Password</h2>
        <p>Enter your new password below.</p>

        <div id="msgBox" class="msg"></div>

        <form id="resetForm" onsubmit="handleReset(event)">
            <input type="password" class="reset-input" id="newPass" placeholder="New Password (min 6 chars)" required minlength="6">
            <input type="password" class="reset-input" id="confirmPass" placeholder="Confirm Password" required minlength="6">
            <button type="submit" class="reset-btn" id="submitBtn">Reset Password</button>
        </form>

        <a href="../index.php" class="back-link">? Back to Homepage</a>
    </div>

    <script>
        function getTokenFromURL() {
            const params = new URLSearchParams(window.location.search);
            return params.get('token') || '';
        }

        async function handleReset(e) {
            e.preventDefault();
            const newPass = document.getElementById('newPass').value;
            const confirmPass = document.getElementById('confirmPass').value;
            const msgBox = document.getElementById('msgBox');
            const btn = document.getElementById('submitBtn');

            if (newPass !== confirmPass) {
                msgBox.className = 'msg error';
                msgBox.textContent = 'Passwords do not match.';
                return;
            }

            const token = getTokenFromURL();
            if (!token) {
                msgBox.className = 'msg error';
                msgBox.textContent = 'Invalid or missing reset token.';
                return;
            }

            btn.disabled = true;
            btn.textContent = 'Processing...';

            const formData = new FormData();
            formData.append('action', 'reset_password');
            formData.append('token', token);
            formData.append('new_password', newPass);

            try {
                const res = await fetch('../includes/auth_handler.php', { method: 'POST', body: formData });
                const data = await res.json();
                if (data.success) {
                    msgBox.className = 'msg success';
                    msgBox.textContent = data.message;
                    document.getElementById('resetForm').style.display = 'none';
                } else {
                    msgBox.className = 'msg error';
                    msgBox.textContent = data.message;
                }
            } catch (err) {
                msgBox.className = 'msg error';
                msgBox.textContent = 'Failed to reset password.';
            } finally {
                btn.disabled = false;
                btn.textContent = 'Reset Password';
            }
        }
    </script>
</body>
</html>
