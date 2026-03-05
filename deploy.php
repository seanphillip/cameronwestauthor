<?php
/**
 * GitHub Webhook Auto-Deploy Script
 * cameronwestauthor.com / JustHost cPanel
 *
 * Place at: /home2/cameronw/public_html/deploy.php
 * Webhook URL: https://cameronwestauthor.com/deploy.php
 */

// ─── CONFIGURATION ───────────────────────────────────────────────────────────

// IMPORTANT: Replace this with your own secret (match exactly what you enter in GitHub)
define('WEBHOOK_SECRET', 'REPLACE_WITH_YOUR_SECRET_TOKEN');

// Absolute path to your site root
define('REPO_PATH', '/home2/cameronw/public_html');

// Branch to deploy from
define('DEPLOY_BRANCH', 'refs/heads/main');

// Log file (kept outside web root is ideal, but this works for shared hosting)
define('LOG_FILE', REPO_PATH . '/deploy_log.txt');

// ─── SECURITY: VALIDATE REQUEST ──────────────────────────────────────────────

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

// Read raw payload
$payload = file_get_contents('php://input');

// Verify GitHub HMAC-SHA256 signature
$signature_header = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
if (empty($signature_header)) {
    log_event('REJECTED: Missing X-Hub-Signature-256 header');
    http_response_code(403);
    exit('Forbidden: Missing signature');
}

$expected = 'sha256=' . hash_hmac('sha256', $payload, WEBHOOK_SECRET);
if (!hash_equals($expected, $signature_header)) {
    log_event('REJECTED: Invalid signature');
    http_response_code(403);
    exit('Forbidden: Invalid signature');
}

// ─── VALIDATE EVENT & BRANCH ─────────────────────────────────────────────────

$event = $_SERVER['HTTP_X_GITHUB_EVENT'] ?? '';
if ($event !== 'push') {
    log_event("SKIPPED: Event type '{$event}' is not a push");
    http_response_code(200);
    exit("OK: Ignoring non-push event");
}

$data = json_decode($payload, true);
$ref  = $data['ref'] ?? '';

if ($ref !== DEPLOY_BRANCH) {
    log_event("SKIPPED: Push was to '{$ref}', not " . DEPLOY_BRANCH);
    http_response_code(200);
    exit("OK: Ignoring push to non-deploy branch");
}

// ─── DEPLOY ──────────────────────────────────────────────────────────────────

log_event('DEPLOY STARTED — pushed by: ' . ($data['pusher']['name'] ?? 'unknown'));

// Set HOME so git can find config on shared hosting
putenv('HOME=' . REPO_PATH);

// Run git pull
$cmd    = 'cd ' . escapeshellarg(REPO_PATH) . ' && /usr/bin/git pull origin main 2>&1';
$output = shell_exec($cmd);

if ($output === null) {
    log_event('ERROR: shell_exec returned null — git may not be accessible');
    http_response_code(500);
    exit('Deploy failed: could not run git');
}

log_event('git output: ' . trim($output));

// Detect success or failure
if (stripos($output, 'error') !== false || stripos($output, 'fatal') !== false) {
    log_event('DEPLOY FAILED');
    http_response_code(500);
    exit('Deploy failed — check deploy_log.txt');
}

log_event('DEPLOY SUCCESS');
http_response_code(200);
echo 'Deployed OK';

// ─── HELPERS ─────────────────────────────────────────────────────────────────

function log_event(string $message): void {
    $line = '[' . date('Y-m-d H:i:s T') . '] ' . $message . PHP_EOL;
    file_put_contents(LOG_FILE, $line, FILE_APPEND | LOCK_EX);
}
