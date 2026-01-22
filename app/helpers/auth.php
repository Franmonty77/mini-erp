<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

/**
 * Attempt to log in a user.
 * 
 * @param string $email
 * @param string $password
 * @return bool True on success, false on failure.
 */
function auth_attempt(string $email, string $password): bool
{
    $pdo = db();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Regenerate session ID to prevent fixation
        session_regenerate_id(true);
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        return true;
    }

    return false;
}

/**
 * Check if user is logged in.
 * 
 * @return bool
 */
function auth_check(): bool
{
    return isset($_SESSION['user_id']);
}

/**
 * Get current logged in user data.
 * 
 * @return array|null
 */
function auth_user(): ?array
{
    if (!auth_check()) {
        return null;
    }

    return [
        'id' => $_SESSION['user_id'],
        'name' => $_SESSION['user_name'],
        'email' => $_SESSION['user_email']
    ];
}

/**
 * Log out the user.
 */
function auth_logout(): void
{
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}

/**
 * Require login to access a page.
 */
function auth_require(): void
{
    if (!auth_check()) {
        header('Location: ' . BASE_URL . '/login.php');
        exit;
    }
}
