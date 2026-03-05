# GitHub Auto-Deploy Setup — cameronwestauthor.com
**Host:** JustHost cPanel &nbsp;|&nbsp; **User:** cameronw &nbsp;|&nbsp; **Repo:** github.com/seanphillip/cameronwestauthor

---

## How It Works

Every time you `git push` to the `main` branch, GitHub sends a POST request to your webhook URL. Your server runs `git pull` automatically, and the live site updates within seconds.

```
Your machine → git push → GitHub → POST to deploy.php → git pull on server → site updated ✅
```

---

## Step 1 — Generate a Secret Token

You need a random secret string that GitHub and your server will share.

**Option A — Terminal (Mac):**
```bash
openssl rand -hex 32
```

**Option B — Online:**
Go to https://www.uuidgenerator.net/ and copy a UUID v4.

**Save this token — you'll use it in Step 2 and Step 3.**

Example token (do not use this one):
```
a7f3c2e91b4d6085f2a3c7e4b1d9f6a2c8e5b3d7f0a4c6e2b8d1f5a3c9e7b2
```

---

## Step 2 — Edit deploy.php on the Server

Open `deploy.php` and replace the placeholder on this line:

```php
define('WEBHOOK_SECRET', 'REPLACE_WITH_YOUR_SECRET_TOKEN');
```

Replace it with your actual token:

```php
define('WEBHOOK_SECRET', 'a7f3c2e91b4d6085f2a3c7e4b1d9f6a2...');
```

Save the file. It will be committed to the repo and deployed in Step 4.

---

## Step 3 — Initialize Git on the Server via SSH

JustHost supports SSH. Open **Terminal** on your Mac.

### 3a. Connect via SSH
```bash
ssh cameronw@cameronwestauthor.com
```
*(Enter your cPanel password when prompted. If SSH is disabled, enable it in cPanel → SSH Access.)*

### 3b. Navigate to public_html and initialize git
```bash
cd /home2/cameronw/public_html
git init
git remote add origin https://github.com/seanphillip/cameronwestauthor.git
```

### 3c. Pull the current site files
```bash
git fetch origin
git checkout -b main --track origin/main
```

If files already exist and you get conflicts:
```bash
git fetch origin
git reset --hard origin/main
```

### 3d. Verify it worked
```bash
git status
# Should show: On branch main, nothing to commit
```

### 3e. Exit SSH
```bash
exit
```

---

## Step 4 — Add the Webhook in GitHub

1. Go to: **https://github.com/seanphillip/cameronwestauthor/settings/hooks**
2. Click **"Add webhook"**
3. Fill in the fields:

| Field | Value |
|---|---|
| **Payload URL** | `https://cameronwestauthor.com/deploy.php` |
| **Content type** | `application/json` |
| **Secret** | *(paste your token from Step 1)* |
| **Which events?** | Just the push event |
| **Active** | ✅ checked |

4. Click **"Add webhook"**

---

## Step 5 — Test It

### Test A — Trigger a deploy from your Mac
Make any small change, then:
```bash
cd "/Users/seanmichael/Desktop/a.WEBSITE PROJECTS/z.CAMWESTAUTHOR"
git add -A
git commit -m "Test webhook deploy"
git push
```

### Test B — Check the GitHub delivery log
1. Go to: **https://github.com/seanphillip/cameronwestauthor/settings/hooks**
2. Click your webhook → **"Recent Deliveries"** tab
3. You should see a green ✅ with HTTP 200
4. Click the delivery to see the full request/response

### Test C — Check the server log
SSH in and read the log:
```bash
ssh cameronw@cameronwestauthor.com
tail -20 /home2/cameronw/public_html/deploy_log.txt
```

A successful deploy looks like:
```
[2026-03-04 18:22:11 UTC] DEPLOY STARTED — pushed by: seanphillip
[2026-03-04 18:22:12 UTC] git output: From https://github.com/seanphillip/cameronwestauthor
                                        main -> origin/main
                                       Updating a1b2c3d..e4f5g6h
                                       Fast-forward
                                        index.html | 12 ++-
[2026-03-04 18:22:12 UTC] DEPLOY SUCCESS
```

---

## Troubleshooting

### ❌ GitHub shows a red ✗ (non-200 response)
- Check that your secret token in `deploy.php` **exactly** matches what you entered in GitHub (no extra spaces)
- Make sure `deploy.php` is accessible at `https://cameronwestauthor.com/deploy.php`

### ❌ "403 Forbidden: Invalid signature"
- Token mismatch. Re-copy it carefully from one place to the other.

### ❌ "Deploy failed: could not run git"
- `shell_exec` may be disabled on your hosting plan. Contact JustHost support and ask them to enable `shell_exec` for your account.
- Or try replacing `/usr/bin/git` in deploy.php with the result of: `which git` (run via SSH)

### ❌ git pull shows "Permission denied"
SSH in and run:
```bash
cd /home2/cameronw/public_html
git remote set-url origin https://YOUR_GITHUB_USERNAME:YOUR_PERSONAL_ACCESS_TOKEN@github.com/seanphillip/cameronwestauthor.git
```
*(Create a GitHub Personal Access Token at: https://github.com/settings/tokens — needs `repo` scope)*

### ❌ Changes not showing on the live site
- Check `deploy_log.txt` — is the push being received?
- Run `git pull` manually via SSH to rule out git issues
- Check cPanel → Error Logs for PHP errors

---

## Quick Reference

| Item | Value |
|---|---|
| Webhook URL | `https://cameronwestauthor.com/deploy.php` |
| Deploy branch | `main` |
| Log file | `/home2/cameronw/public_html/deploy_log.txt` |
| GitHub webhooks | `github.com/seanphillip/cameronwestauthor/settings/hooks` |
| cPanel login | `https://cameronwestauthor.com:2083` |

---

## Security Notes

- The secret token uses **HMAC-SHA256** — the same method GitHub recommends
- Requests without a valid signature are rejected with HTTP 403
- Only `push` events to `main` trigger a deploy — all others are ignored
- `deploy_log.txt` is world-readable via browser; consider adding this to `.htaccess` to block public access:

```apache
# Add to .htaccess to protect the log file
<Files "deploy_log.txt">
    Order allow,deny
    Deny from all
</Files>
```
