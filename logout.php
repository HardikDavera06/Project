<?php
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Regenerate session ID to prevent session fixation
session_regenerate_id(true);

// Set aggressive no-cache headers
header("Cache-Control: no-cache, no-store, must-revalidate, private");
header("Pragma: no-cache");
header("Expires: 0");
header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");

// Additional security headers
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");

// Clear session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out...</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <script>
        // Prevent browser back button from working after logout
        window.history.forward();
        
        // Clear any cached data
        if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
            window.location.href = 'index2.php';
        }
        
        // Additional cache clearing
        if ('caches' in window) {
            caches.keys().then(function(names) {
                for (let name of names) {
                    caches.delete(name);
                }
            });
        }
        
        // Redirect after a short delay to ensure all cleanup is done
        setTimeout(function() {
            window.location.href = 'index2.php';
        }, 100);
    </script>
</head>
<body>
    <div style="text-align: center; margin-top: 100px; font-family: Arial, sans-serif;">
        <h2>Logging out...</h2>
        <p>Please wait while we securely log you out.</p>
        <p>If you are not redirected automatically, <a href="index2.php">click here</a>.</p>
    </div>
</body>
</html>
<?php
// Final redirect as fallback
header("Location: index2.php");
exit();
?>