<?php
class FrontController
{
    protected array $rayons;
    protected array $boutiques;
    protected array $products;
    protected array $photos;
    protected $nav;
    protected $layout;

    public function __construct()
    {
        $this -> setMenu();
        $this->nav = 'view_nav.phtml';
        $this->layout = 'views/layout.phtml';
    }

    public function setMenu()
    {
        $model = new RayonsModel();
        $this -> rayons = $model -> getAllRayons();
        $model2 = new BoutiquesModel();
        $this -> boutiques = $model2 -> getAllBoutiques();
        $model3 = new PhotosModel();
        $this -> photos = $model3 -> getAllPhotos();
        $model4 = new ProductsModel();
        $this -> products = $model4 -> getAllProducts();
    }

    public function createCookie()
    {
        setcookie('name', 'client', time() + 10 * 24 * 60 * 60);
    }
}