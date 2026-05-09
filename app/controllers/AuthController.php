<?php

class AuthController extends Controller
{
    public function login(): void
    {
        if (is_logged_in()) {
            $this->redirect(is_admin() ? url('/admin') : url('/dashboard'));
        }

        $this->view('auth/login', [
            'title' => 'Login',
            'demoUsers' => require ROOT_PATH . '/config/demo_users.php',
            'error' => flash('error'),
            'success' => flash('success'),
        ]);
    }

    public function authenticate(): void
    {
        if (!csrf_is_valid($_POST['_csrf'] ?? null)) {
            flash('error', 'Session expired. Please try again.');
            $this->redirect(url('/login'));
        }

        $email = strtolower(trim($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');
        $demoUsers = require ROOT_PATH . '/config/demo_users.php';
        $user = $demoUsers[$email] ?? null;

        if (!$user || !hash_equals($user['password'], $password)) {
            flash('error', 'Invalid email or password.');
            $this->redirect(url('/login'));
        }

        session_regenerate_id(true);
        unset($user['password']);
        $_SESSION['user'] = $user;

        $intendedUrl = $_SESSION['intended_url'] ?? null;
        unset($_SESSION['intended_url']);

        if (($user['role'] ?? '') === 'admin' && is_string($intendedUrl) && str_contains($intendedUrl, '/dashboard')) {
            $this->redirect(url('/admin'));
        }

        if (is_string($intendedUrl) && $intendedUrl !== '') {
            $this->redirect($intendedUrl);
        }

        $this->redirect(($user['role'] ?? '') === 'admin' ? url('/admin') : url('/dashboard'));
    }

    public function register(): void
    {
        if (is_logged_in()) {
            $this->redirect(url('/dashboard'));
        }

        $this->view('auth/register', [
            'title' => 'Register',
            'error' => flash('error'),
            'success' => flash('success'),
        ]);
    }

    public function store(): void
    {
        if (!csrf_is_valid($_POST['_csrf'] ?? null)) {
            flash('error', 'Session expired. Please try again.');
            $this->redirect(url('/register'));
        }

        $name = trim($_POST['name'] ?? '');
        $email = strtolower(trim($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');
        $role = $_POST['role'] ?? 'buyer';
        $allowedRoles = ['buyer', 'seller', 'agent'];

        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8 || !in_array($role, $allowedRoles, true)) {
            flash('error', 'Please enter a valid name, email, role, and password with at least 8 characters.');
            $this->redirect(url('/register'));
        }

        session_regenerate_id(true);
        $_SESSION['user'] = [
            'id' => time(),
            'name' => $name,
            'email' => $email,
            'role' => $role,
        ];

        $this->redirect(url('/dashboard'));
    }

    public function forgot(): void
    {
        $this->view('auth/forgot', ['title' => 'Forgot Password', 'success' => flash('success'), 'error' => flash('error')]);
    }

    public function sendReset(): void
    {
        if (!csrf_is_valid($_POST['_csrf'] ?? null)) {
            flash('error', 'Session expired. Please try again.');
            $this->redirect(url('/forgot-password'));
        }

        flash('success', 'Password reset link generated for demo mode. In production this will email the user.');
        $this->redirect(url('/forgot-password'));
    }

    public function logout(): void
    {
        session_regenerate_id(true);
        $_SESSION = [];
        session_destroy();
        $this->redirect(url('/login'));
    }
}
