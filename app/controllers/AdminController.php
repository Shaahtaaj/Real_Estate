<?php

require_once APP_PATH . '/models/EstateStore.php';

class AdminController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        require_once APP_PATH . '/models/EstateStore.php';
        $this->view('admin/index', ['title' => 'Admin Panel', 'store' => EstateStore::all(), 'stats' => EstateStore::stats(), 'success' => flash('success')]);
    }

    public function users(): void
    {
        $this->requireAdmin();
        require_once APP_PATH . '/models/EstateStore.php';
        $this->view('admin/users', ['title' => 'User Management', 'users' => EstateStore::all()['users'], 'success' => flash('success')]);
    }

    public function listings(): void
    {
        $this->requireAdmin();
        require_once APP_PATH . '/models/EstateStore.php';
        $this->view('admin/listings', ['title' => 'Manage Listings', 'properties' => EstateStore::properties(null, true), 'success' => flash('success')]);
    }

    public function approvals(): void
    {
        $this->requireAdmin();
        require_once APP_PATH . '/models/EstateStore.php';
        $pending = array_values(array_filter(EstateStore::properties(null, true), fn (array $property): bool => $property['status'] === 'pending'));
        $this->view('admin/listings', ['title' => 'Property Approval', 'properties' => $pending, 'success' => flash('success')]);
    }

    public function analytics(): void
    {
        $this->requireAdmin();
        require_once APP_PATH . '/models/EstateStore.php';
        $this->view('admin/index', ['title' => 'Analytics', 'store' => EstateStore::all(), 'stats' => EstateStore::stats(), 'success' => flash('success')]);
    }

    public function inquiries(): void
    {
        $this->requireAdmin();
        require_once APP_PATH . '/models/EstateStore.php';
        $this->view('admin/inquiries', ['title' => 'Inquiries', 'inquiries' => EstateStore::all()['inquiries'], 'success' => flash('success')]);
    }

    public function updateListingStatus(string $slug): void
    {
        $this->requireAdmin();
        $this->validateCsrf();
        EstateStore::setPropertyStatus($slug, $_POST['status'] ?? 'pending');
        flash('success', 'Listing status updated.');
        $this->redirect($_SERVER['HTTP_REFERER'] ?? url('/admin/listings'));
    }

    public function updateUserStatus(string $id): void
    {
        $this->requireAdmin();
        $this->validateCsrf();
        EstateStore::updateUserStatus((int) $id, $_POST['status'] ?? 'active');
        flash('success', 'User status updated.');
        $this->redirect(url('/admin/users'));
    }

    public function updateInquiryStatus(string $id): void
    {
        $this->requireAdmin();
        $this->validateCsrf();
        EstateStore::updateInquiryStatus((int) $id, $_POST['status'] ?? 'contacted');
        flash('success', 'Inquiry status updated.');
        $this->redirect(url('/admin/inquiries'));
    }

    private function validateCsrf(): void
    {
        if (!csrf_is_valid($_POST['_csrf'] ?? null)) {
            flash('error', 'Session expired. Please try again.');
            $this->redirect(url('/login'));
        }
    }
}
