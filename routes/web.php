<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShippingsController;
use App\Http\Controllers\TypeVenteController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/politique-confidentialite', function () {return Inertia::render('Auth/Pages/Legales/PolitiqueConfidentialite');})->name('politique-confidentialite');
Route::get('/files/identiter/{file}', [FilesController::class, 'get_identiter']);
Route::get('/files/kbis/{file}', [FilesController::class, 'get_kbis']);

Route::middleware('guest')->group(function () {
   Route::get('/', [AuthenticatedSessionController::class, 'create']);
   Route::post('/uploadIdentiter', [RegisteredUserController::class, 'uploadIdentiter']);
   Route::post('/uploadKbis', [RegisteredUserController::class, 'uploadKbis']);

});

Route::middleware(['auth', 'verified'])->group(function () {
   Route::get('/type_order', [TypeVenteController::class, 'create'])->name('type_order');
   Route::get('/type_order/warehouse', [TypeVenteController::class, 'choix_entrepot'])->name('type_order/warehouse');
   Route::get('/type_order/customers', [TypeVenteController::class, 'choix_clients'])->name('type_order/customers');
   Route::get('/type_order/about-us', function () {return Inertia::render('Auth/Pages/AboutUs');})->name('type_order/about-us');
});


Route::middleware(['auth', 'verified','type-vente'])->group(function () {
   Route::get('/', function () {return Inertia::render('Auth/Pages/Home');});
   Route::get('/home', function () {return Inertia::render('Auth/Pages/Home');})->name('home');
   Route::get('/about-us', function () {return Inertia::render('Auth/Pages/AboutUs');})->name('about-us');
   
   Route::get('/settings', [SettingsController::class, 'create'])->name('settings');
   Route::post('/settings/save/security', [SettingsController::class, 'edit_secu'])->name('settings/save/security');
   Route::post('/settings/save/general', [SettingsController::class, 'edit_general'])->name('settings/save/general');
   Route::post('/settings/save/company', [SettingsController::class, 'edit_societe'])->name('settings/save/company');
   Route::post('/settings/save/profil', [SettingsController::class, 'edit_profil'])->name('settings/save/profil');
   Route::post('/settings/save/sociaux', [SettingsController::class, 'edit_sociaux'])->name('settings/save/sociaux');

   Route::get('/products', [ProductsController::class, 'create'])->name('products');
   Route::post('/products', [ProductsController::class, 'create_post'])->name('products');
   Route::get('/products/{gamme}', [ProductsController::class, 'create_product']);
   Route::post('/products/{gamme}/search', [ProductsController::class, 'create_product_post']);
   Route::get('/products/{gamme}/search', [ProductsController::class, 'create_redirect_product']);
   Route::post('/products/design', [ProductsController::class, 'getProductsDesign']);

   Route::get('/shippings', [ShippingsController::class, 'create'])->name('shippings');

   Route::middleware(['type-entrepot'])->group(function () {
      Route::post('/products/panier/add', [ProductsController::class, 'add_product_commande'])->name('products/panier/add');
      Route::post('/products/panier/delete', [ProductsController::class, 'delete_product_commande'])->name('products/panier/delete');
      Route::post('/products/panier/import', [ProductsController::class, 'import_panier_commande'])->name('orders/clients/import');

      Route::post('/shippings/panier/edit', [ShippingsController::class, 'edit_panier'])->name('shippings/panier/edit');
      Route::post('/shippings/panier/delete', [ShippingsController::class, 'delete_commande'])->name('shippings/panier/delete');

      Route::get('/cart', [CartController::class, 'create'])->name('cart');
      Route::post('/cart/products/edit', [CartController::class, 'edit_qte'])->name('cart/products/edit');
      Route::post('/cart/products/delete', [CartController::class, 'delete_card_product'])->name('cart/products/delete');
      Route::get('/cart/adresses', [CartController::class, 'create_adresses'])->name('cart/adresses');
      Route::post('/cart/adresses', [CartController::class, 'add_adresse_commande'])->name('cart/adresses');
      Route::get('/cart/adresses/validation', [CartController::class, 'create_adresses_validation'])->name('cart/adresses/validation');
      Route::post('/cart/adresses/validation/order', [CartController::class, 'confirmation_panier_com'])->name('cart/adresses/validation/order');
   });

   Route::middleware(['type-client'])->group(function () {
      Route::get('/orders', [OrdersController::class, 'create_clients'])->name('orders');
      Route::post('/orders/design', [OrdersController::class, 'getProductsDesignPanier'])->name('/orders/design');
      Route::get('/orders/clients', [OrdersController::class, 'create_clients'])->name('orders/clients');
      Route::post('/orders/clients', [OrdersController::class, 'add_client'])->name('orders/clients');
      Route::get('/orders/clients/add', [OrdersController::class, 'create_add_clients'])->name('orders/clients/add');
      Route::post('/orders/clients/import', [OrdersController::class, 'add_client_import'])->name('orders/clients/import');
      Route::post('/orders/clients/import/validation', [OrdersController::class, 'validation_clients_fichier'])->name('orders/clients/import/validation');

      Route::get('/orders/clients/products', [OrdersController::class, 'create_client_gamme'])->name('orders/clients/products');
      Route::post('/orders/clients/products', [OrdersController::class, 'create_client_gamme_post'])->name('orders/clients/products');
      Route::get('/orders/clients/products/{gamme}', [OrdersController::class, 'create_client_products']);
      Route::post('/orders/clients/products/{gamme}/search', [OrdersController::class, 'create_product_post']);
      Route::get('/orders/clients/products/{gamme}/search', [OrdersController::class, 'create_redirect_product']);
      Route::post('/orders/clients/products/{gamme}/add', [OrdersController::class, 'add_product_commande'])->name('orders/clients/products/{gamme}/add');
      Route::post('/orders/clients/products/{gamme}/delete', [OrdersController::class, 'delete_product_commande'])->name('orders/clients/products/{gamme}/delete');
      Route::get('/orders/clients/products/{gamme}/view', [OrdersController::class, 'view_product_commande'])->name('orders/clients/products/{gamme}/view');
   
      Route::get('/orders/clients/validation', [OrdersController::class, 'validation_commande_clients'])->name('orders/clients/validation');
      Route::post('/orders/clients/validation/add', [OrdersController::class, 'add_product_commande'])->name('orders/clients/products/{gamme}/add');
      Route::post('/orders/clients/validation/delete', [OrdersController::class, 'delete_product_commande'])->name('orders/clients/products/{gamme}/delete');
      Route::post('/orders/clients/confirmation', [OrdersController::class, 'confirmation_order_clients'])->name('orders/clients/confirmation');
      Route::post('/orders/clients/orders', [OrdersController::class, 'get_order_client'])->name('orders/clients/orders');
      Route::post('/orders/clients/delete', [OrdersController::class, 'delete_order_client'])->name('orders/clients/delete');
      Route::post('/orders/clients/edit', [OrdersController::class, 'edit_order_client'])->name('orders/clients/edit');

      Route::post('/shippings/edit', [ShippingsController::class, 'edit_commande'])->name('shippings/edit');
      Route::post('/shippings/delete', [ShippingsController::class, 'delete_commande'])->name('shippings/delete');

      
      Route::post('/shippings/order/clients/{num_commande}/products', [ShippingsController::class, 'get_order_client'])->name('shippings/order/clients/{num_commande}/products');
   });

   Route::get('/shippings/order/clients/{num_commande}', [ShippingsController::class, 'create_order'])->name('shippings/order/clients/{num_commande}');
   Route::get('/shippings/order/clients/{num_commande}/visuel', [ShippingsController::class, 'get_visuel_order_zip'])->name('shippings/order/clients/{num_commande}/visuel');
   Route::get('/shippings/order/clients/{num_commande}/pdf/facture', [PDFController::class, 'generatePDF_facture'])->name('shippings/order/clients/{num_commande}/pdf/facture');
   Route::get('/shippings/order/clients/{num_commande}/pdf/proforma', [PDFController::class, 'generatePDF_proforma'])->name('shippings/order/clients/{num_commande}/pdf/proforma');
   
   
});

Route::get('language/{language}', function ($language) {
   Session::put('locale', $language);
   return true;
})->name('language');

require __DIR__.'/auth.php';
