<?php
// Fichier de debug pour Railway

echo "<h1>RiosApp Debug</h1>";
echo "<h2>Server Info:</h2>";
echo "<pre>";
echo "REQUEST_URI: " . ($_SERVER['REQUEST_URI'] ?? 'NOT SET') . "\n";
echo "REQUEST_METHOD: " . ($_SERVER['REQUEST_METHOD'] ?? 'NOT SET') . "\n";
echo "SCRIPT_NAME: " . ($_SERVER['SCRIPT_NAME'] ?? 'NOT SET') . "\n";
echo "QUERY_STRING: " . ($_SERVER['QUERY_STRING'] ?? 'NOT SET') . "\n";
echo "HTTP_HOST: " . ($_SERVER['HTTP_HOST'] ?? 'NOT SET') . "\n";
echo "SERVER_NAME: " . ($_SERVER['SERVER_NAME'] ?? 'NOT SET') . "\n";
echo "DOCUMENT_ROOT: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'NOT SET') . "\n";
echo "</pre>";

echo "<h2>Environment Variables:</h2>";
echo "<pre>";
echo "RAILWAY_ENVIRONMENT_NAME: " . (getenv('RAILWAY_ENVIRONMENT_NAME') ?: 'NOT SET') . "\n";
echo "DB_HOST: " . (getenv('DB_HOST') ?: 'NOT SET') . "\n";
echo "PUBG_API_KEY: " . (getenv('PUBG_API_KEY') ? 'SET' : 'NOT SET') . "\n";
echo "</pre>";

echo "<h2>Files in root:</h2>";
echo "<pre>";
print_r(scandir('/var/www/html'));
echo "</pre>";

echo "<h2>Apache modules:</h2>";
echo "<pre>";
if (function_exists('apache_get_modules')) {
    print_r(apache_get_modules());
} else {
    echo "apache_get_modules() not available\n";
}
echo "</pre>";

echo "<h2>Test routes:</h2>";
echo '<p><a href="/login">Test /login</a></p>';
echo '<p><a href="/register">Test /register</a></p>';
echo '<p><a href="/players">Test /players</a></p>';
echo '<p><a href="/debug.php">This debug page</a></p>';
?>