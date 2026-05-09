<?php

class PageController extends Controller
{
    public function about(): void
    {
        $this->view('pages/about', ['title' => 'About Memon Estate']);
    }

    public function contact(): void
    {
        $this->view('pages/contact', ['title' => 'Contact Memon Estate', 'success' => flash('success'), 'error' => flash('error')]);
    }

    public function submitContact(): void
    {
        if (!csrf_is_valid($_POST['_csrf'] ?? null)) {
            flash('error', 'Session expired. Please try again.');
            $this->redirect(url('/contact'));
        }

        require_once APP_PATH . '/models/EstateStore.php';
        EstateStore::addInquiry([
            'name' => $_POST['name'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'message' => $_POST['message'] ?? 'General website inquiry',
        ], 'general-contact');

        flash('success', 'Message sent. Memon Estate will contact you shortly.');
        $this->redirect(url('/contact'));
    }

    public function offline(): void
    {
        $this->view('pages/offline', ['title' => 'Offline']);
    }

    public function app(): void
    {
        $this->view('pages/app', ['title' => 'Memon Estate App']);
    }
}
