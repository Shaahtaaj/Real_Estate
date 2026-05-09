<?php

declare(strict_types=1);

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        view($view, $data);
    }

    protected function redirect(string $path): void
    {
        header("Location: {$path}");
        exit;
    }

    protected function requireAuth(): void
    {
        if (is_logged_in()) {
            return;
        }

        $_SESSION['intended_url'] = $_SERVER['REQUEST_URI'] ?? url('/dashboard');
        $this->redirect(url('/login'));
    }

    protected function requireAdmin(): void
    {
        $this->requireAuth();

        if (is_admin()) {
            return;
        }

        http_response_code(403);
        $this->view('pages/403', ['title' => 'Access denied']);
        exit;
    }
}
