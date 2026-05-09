<?php

class DashboardController extends Controller
{
    public function index(): void
    {
        $this->requireAuth();
        if (is_admin()) {
            $this->redirect(url('/admin'));
        }
        require_once APP_PATH . '/models/EstateStore.php';
        $userId = (int) current_user()['id'];
        $this->view('dashboard/index', [
            'title' => 'User Dashboard',
            'properties' => EstateStore::userProperties($userId),
            'favorites' => EstateStore::favorites($userId),
            'store' => EstateStore::all(),
            'success' => flash('success'),
        ]);
    }

    public function properties(): void
    {
        $this->requireAuth();
        if (is_admin()) {
            $this->redirect(url('/admin/listings'));
        }
        require_once APP_PATH . '/models/EstateStore.php';
        $this->view('dashboard/properties', [
            'title' => 'My Properties',
            'properties' => EstateStore::userProperties((int) current_user()['id']),
            'success' => flash('success'),
        ]);
    }

    public function addListing(): void
    {
        $this->requireAuth();
        if (is_admin()) {
            $this->redirect(url('/admin/listings'));
        }
        $this->view('properties/form', ['title' => 'Add Listing', 'mode' => 'Add', 'property' => null, 'action' => url('/properties/add')]);
    }

    public function favorites(): void
    {
        $this->requireAuth();
        if (is_admin()) {
            $this->redirect(url('/admin'));
        }
        require_once APP_PATH . '/models/EstateStore.php';
        $this->view('dashboard/favorites', ['title' => 'Saved Properties', 'properties' => EstateStore::favorites((int) current_user()['id'])]);
    }

    public function profile(): void
    {
        $this->requireAuth();
        if (is_admin()) {
            $this->redirect(url('/admin'));
        }
        $this->view('dashboard/profile', ['title' => 'Profile Settings', 'success' => flash('success'), 'error' => flash('error')]);
    }

    public function updateProfile(): void
    {
        $this->requireAuth();
        if (is_admin()) {
            $this->redirect(url('/admin'));
        }
        if (!csrf_is_valid($_POST['_csrf'] ?? null)) {
            flash('error', 'Session expired. Please try again.');
            $this->redirect(url('/dashboard/profile'));
        }

        $_SESSION['user']['name'] = trim($_POST['name'] ?? current_user()['name']);
        $_SESSION['user']['email'] = strtolower(trim($_POST['email'] ?? current_user()['email']));
        $_SESSION['user']['phone'] = trim($_POST['phone'] ?? '');
        flash('success', 'Profile updated for this session.');
        $this->redirect(url('/dashboard/profile'));
    }

    public function notifications(): void
    {
        $this->requireAuth();
        if (is_admin()) {
            $this->redirect(url('/admin/inquiries'));
        }
        require_once APP_PATH . '/models/EstateStore.php';
        $data = EstateStore::all();
        $userSlugs = array_column(EstateStore::userProperties((int) current_user()['id']), 'slug');
        $notifications = array_values(array_filter($data['inquiries'], fn (array $inquiry): bool => in_array($inquiry['property_slug'], $userSlugs, true)));
        $this->view('dashboard/notifications', ['title' => 'Notifications', 'notifications' => $notifications]);
    }
}
