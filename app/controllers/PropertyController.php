<?php

require_once APP_PATH . '/models/Property.php';
require_once APP_PATH . '/models/EstateStore.php';

class PropertyController extends Controller
{
    public function index(): void
    {
        $this->view('properties/index', [
            'title' => 'Property Listings',
            'properties' => EstateStore::properties($_GET),
        ]);
    }

    public function search(): void
    {
        $this->view('properties/search', [
            'title' => 'Advanced Search',
            'properties' => EstateStore::properties($_GET),
            'filters' => $_GET,
        ]);
    }

    public function add(): void
    {
        $this->requireAuth();
        $this->view('properties/form', [
            'title' => 'Add Property',
            'mode' => 'Add',
            'property' => null,
            'action' => url('/properties/add'),
        ]);
    }

    public function store(): void
    {
        $this->requireAuth();
        $this->validateCsrf();
        $uploadedImages = ImageUpload::propertyImages($_FILES['images'] ?? []);
        $property = EstateStore::upsertProperty($_POST, null, $uploadedImages);
        flash('success', 'Property submitted for admin approval.');
        $this->redirect(url('/properties/' . $property['slug'] . '/edit'));
    }

    public function edit(string $slug): void
    {
        $this->requireAuth();
        $property = Property::findBySlug($slug);
        $this->authorizeProperty($property);
        $this->view('properties/form', [
            'title' => 'Edit Property',
            'mode' => 'Edit',
            'property' => $property,
            'action' => url('/properties/' . $slug . '/edit'),
        ]);
    }

    public function update(string $slug): void
    {
        $this->requireAuth();
        $this->validateCsrf();
        $this->authorizeProperty(Property::findBySlug($slug));
        $uploadedImages = ImageUpload::propertyImages($_FILES['images'] ?? []);
        EstateStore::upsertProperty($_POST, $slug, $uploadedImages);
        if (!is_admin()) {
            EstateStore::setPropertyStatus($slug, 'pending');
        }
        flash('success', 'Property updated and sent to admin approval queue.');
        $this->redirect(url('/dashboard/properties'));
    }

    public function delete(string $slug): void
    {
        $this->requireAuth();
        $property = Property::findBySlug($slug);
        $this->authorizeProperty($property);
        $this->view('properties/delete', [
            'title' => 'Delete Property',
            'property' => $property,
        ]);
    }

    public function destroy(string $slug): void
    {
        $this->requireAuth();
        $this->validateCsrf();
        $this->authorizeProperty(Property::findBySlug($slug));
        EstateStore::deleteProperty($slug);
        flash('success', 'Property deleted.');
        $this->redirect(url('/dashboard/properties'));
    }

    public function show(string $slug): void
    {
        $property = Property::findBySlug($slug);

        if (!$property) {
            http_response_code(404);
            $this->view('pages/404', ['title' => 'Property not found']);
            return;
        }

        $canPreview = is_logged_in() && (is_admin() || (int) $property['user_id'] === (int) current_user()['id']);
        if (($property['status'] ?? '') !== 'active' && !$canPreview) {
            http_response_code(404);
            $this->view('pages/404', ['title' => 'Property not available']);
            return;
        }

        $this->view('properties/show', [
            'title' => $property['title'],
            'property' => $property,
            'properties' => EstateStore::properties(),
            'success' => flash('success'),
        ]);
    }

    public function inquiry(string $slug): void
    {
        $this->validateCsrf();
        EstateStore::addInquiry($_POST, $slug);
        flash('success', 'Inquiry sent. The agent can contact you on WhatsApp/phone.');
        $this->redirect(url('/property/' . $slug));
    }

    public function favorite(string $slug): void
    {
        $this->requireAuth();
        $this->validateCsrf();
        EstateStore::toggleFavorite((int) current_user()['id'], $slug);
        $this->redirect($_SERVER['HTTP_REFERER'] ?? url('/properties'));
    }

    private function validateCsrf(): void
    {
        if (!csrf_is_valid($_POST['_csrf'] ?? null)) {
            flash('error', 'Session expired. Please try again.');
            $this->redirect(url('/login'));
        }
    }

    private function authorizeProperty(?array $property): void
    {
        if (!$property) {
            http_response_code(404);
            $this->view('pages/404', ['title' => 'Property not found']);
            exit;
        }

        if (is_admin() || (int) $property['user_id'] === (int) current_user()['id']) {
            return;
        }

        http_response_code(403);
        $this->view('pages/403', ['title' => 'Access denied']);
        exit;
    }
}
