<?php 

namespace App\Core\Session;

class Session {
    /**
     * Start the session.
     */
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Set a session value.
     *
     * @param string $key
     * @param mixed $value
     */
    public static function set($key, $value) {
        self::start();
        $_SESSION['SessionClass'][$key] = $value;
    }

    /**
     * Get a session value.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed|null
     */
    public static function get($key, $default = null) {
        self::start();
        return isset($_SESSION['SessionClass'][$key]) ? $_SESSION['SessionClass'][$key] : $default;
    }

    /**
     * Remove a session value.
     *
     * @param string $key
     */
    public static function remove($key) {
        self::start();
        if (isset($_SESSION['SessionClass'][$key])) {
            unset($_SESSION['SessionClass'][$key]);
        }
    }

    /**
     * Destroy the session.
     */
    public static function destroy() {
        self::start();
        session_unset();
        session_destroy();
    }

    /**
     * Regenerate the session ID.
     */
    public static function regenerate() {
        self::start();
        session_regenerate_id(true);
    }
}
?>
