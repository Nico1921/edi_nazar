<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderEntrepotController;
use App\Http\Controllers\DropshippingController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShippingsController;
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
Route::get('/cgv', function () {return Inertia::render('Auth/Pages/Legales/CGV');})->name('cgv');
Route::get('/files/identiter/{file}', [FilesController::class, 'get_identiter']);
Route::get('/files/kbis/{file}', [FilesController::class, 'get_kbis']);

Route::middleware('guest')->group(function () {
   Route::get('/', [AuthenticatedSessionController::class, 'create']);
   Route::post('/uploadIdentiter', [RegisteredUserController::class, 'uploadIdentiter']);
   Route::post('/uploadKbis', [RegisteredUserController::class, 'uploadKbis']);
});


Route::middleware(['auth', 'verified'])->group(function () {
   Route::get('/', function () {return Inertia::render('Auth/Pages/Home');});
   Route::get('/home', function () {return Inertia::render('Auth/Pages/Home');})->name('home');
   Route::get('/about-us', function () {return Inertia::render('Auth/Pages/AboutUs');})->name('about-us');
   
   Route::get('/settings', [SettingsController::class, 'create'])->name('settings');
   Route::post('/settings/save/security', [SettingsController::class, 'edit_secu'])->name('settings/save/security');
   Route::post('/settings/save/general', [SettingsController::class, 'edit_general'])->name('settings/save/general');
   Route::post('/settings/save/company', [SettingsController::class, 'edit_societe'])->name('settings/save/company');
   Route::post('/settings/save/profil', [SettingsController::class, 'edit_profil'])->name('settings/save/profil');
   Route::post('/settings/save/sociaux', [SettingsController::class, 'edit_sociaux'])->name('settings/save/sociaux');

   Route::get('/order_entrepot', [OrderEntrepotController::class, 'create_type_vente'])->name('order_entrepot');
   Route::middleware(['type-entrepot'])->group(function () {
      Route::get('/order_entrepot/gamme', [OrderEntrepotController::class, 'create'])->name('order_entrepot/gamme');
      Route::post('/order_entrepot/gamme', [OrderEntrepotController::class, 'create_post'])->name('order_entrepot/gamme');
      Route::get('/order_entrepot/gamme/{gamme}', [OrderEntrepotController::class, 'create_product']);
      Route::post('/order_entrepot/gamme/{gamme}/search', [OrderEntrepotController::class, 'create_product_post']);
      Route::get('/order_entrepot/gamme/{gamme}/search', [OrderEntrepotController::class, 'create_redirect_product']);
      Route::post('/order_entrepot/gamme/design', [OrderEntrepotController::class, 'getProductsDesign']);
      Route::post('/order_entrepot/panier/add', [OrderEntrepotController::class, 'add_product_commande'])->name('order_entrepot/panier/add');
      Route::post('/order_entrepot/panier/delete', [OrderEntrepotController::class, 'delete_product_commande'])->name('order_entrepot/panier/delete');
      Route::post('/order_entrepot/panier/import', [OrderEntrepotController::class, 'import_panier_commande'])->name('order_entrepot/panier/import');

      Route::get('/cart', [CartController::class, 'create'])->name('cart');
      Route::get('/cart/payment/cb/valid', [CartController::class, 'redirect_cb_validation_com'])->name('cart/payment/cb/valid');
      Route::post('/cart/products/edit', [CartController::class, 'edit_qte'])->name('cart/products/edit');
      Route::post('/cart/products/delete', [CartController::class, 'delete_card_product'])->name('cart/products/delete');
      Route::middleware(['check-panier-com'])->group(function () {
         Route::get('/cart/adresses', [CartController::class, 'create_adresses'])->name('cart/adresses');
         Route::post('/cart/adresses', [CartController::class, 'add_adresse_commande'])->name('cart/adresses');
         Route::post('/cart/payment/cb', [CartController::class, 'generate_form_payment_cb'])->name('cart/payment/cb');
         Route::get('/cart/payment/cb/error', [CartController::class, 'redirect_cb_error_com'])->name('cart/payment/cb/error');
         Route::get('/cart/adresses/validation', [CartController::class, 'create_adresses_validation'])->name('cart/adresses/validation');
         Route::post('/cart/adresses/validation/order', [CartController::class, 'confirmation_panier_com'])->name('cart/adresses/validation/order');
      });
   });

   Route::get('/dropshipping', [DropshippingController::class, 'create_type_vente'])->name('dropshipping');
   Route::middleware(['type-client'])->group(function () {
      Route::post('/dropshipping/gamme/design', [DropshippingController::class, 'getProductsDesignPanier'])->name('/dropshipping/gamme/design');

      // Route::get('/dropshipping/clients', [DropshippingController::class, 'create_clients'])->name('dropshipping/clients');
      Route::post('/dropshipping/clients/add', [DropshippingController::class, 'add_ref_client'])->name('dropshipping/clients/add');
      Route::post('/dropshipping/clients/update', [DropshippingController::class, 'add_client'])->name('dropshipping/clients/update');

      Route::post('/dropshipping/clients/import', [DropshippingController::class, 'add_client_import'])->name('dropshipping/clients/import');
      Route::post('/dropshipping/clients/import/validation', [DropshippingController::class, 'validation_clients_fichier'])->name('dropshipping/clients/import/validation');

      Route::get('/dropshipping/gamme', [DropshippingController::class, 'create_client_gamme'])->name('dropshipping/gamme');
      Route::post('/dropshipping/gamme', [DropshippingController::class, 'create_client_gamme_post'])->name('dropshipping/gamme');
      Route::get('/dropshipping/gamme/{gamme}', [DropshippingController::class, 'create_client_products']);
      Route::post('/dropshipping/gamme/{gamme}/search', [DropshippingController::class, 'create_product_post']);
      Route::get('/dropshipping/gamme/{gamme}/search', [DropshippingController::class, 'create_redirect_product']);

      Route::post('/dropshipping/panier/add', [DropshippingController::class, 'add_product_commande'])->name('dropshipping/panier/add');
      Route::post('/dropshipping/panier/delete', [DropshippingController::class, 'delete_product_commande'])->name('dropshipping/panier/delete');
      Route::get('/dropshipping/panier/view', [DropshippingController::class, 'view_product_commande'])->name('dropshipping/panier/view');
      Route::get('/dropshipping/panier/get', [DropshippingController::class, 'getPanierDrop'])->name('dropshipping/panier/get');
   
      Route::get('/dropshipping/clients/validation', [DropshippingController::class, 'validation_commande_clients'])->name('dropshipping/clients/validation');
      Route::post('/dropshipping/clients/validation/add', [DropshippingController::class, 'add_product_commande'])->name('orders/clients/products/{gamme}/add');
      Route::post('/dropshipping/clients/validation/delete', [DropshippingController::class, 'delete_product_commande'])->name('orders/clients/products/{gamme}/delete');
      
      Route::post('/dropshipping/clients/confirmation', [DropshippingController::class, 'confirmation_order_clients'])->name('orders/clients/confirmation');
      Route::post('/dropshipping/clients/orders', [DropshippingController::class, 'get_order_client'])->name('orders/clients/orders');
      Route::post('/dropshipping/clients/delete', [DropshippingController::class, 'delete_order_client'])->name('orders/clients/delete');
      Route::post('/dropshipping/clients/edit', [DropshippingController::class, 'edit_order_client'])->name('orders/clients/edit');

      Route::get('/dropshipping/cart', [CartController::class, 'create'])->name('dropshipping/cart');
      Route::get('/dropshipping/cart/payment/cb/valid', [CartController::class, 'redirect_cb_validation_drop'])->name('dropshipping/cart/payment/cb/valid');
      Route::post('/dropshipping/cart/products/edit', [CartController::class, 'edit_qte_drop'])->name('dropshipping/cart/products/edit');
      Route::post('/dropshipping/cart/products/delete', [CartController::class, 'delete_card_product_drop'])->name('dropshipping/cart/products/delete');
      Route::middleware(['check-panier-drop'])->group(function () {
         
         Route::post('/dropshipping/cart/client/delete', [CartController::class, 'delete_order_client_drop'])->name('dropshipping/cart/client/delete');
         Route::get('/dropshipping/cart/adresses', [CartController::class, 'create_adresse_drop'])->name('dropshipping/cart/adresses');
         Route::post('/dropshipping/cart/adresses', [CartController::class, 'add_adresse_commande_drop'])->name('dropshipping/cart/adresses');
         Route::post('/dropshipping/cart/payment/cb', [CartController::class, 'generate_form_payment_cb_drop'])->name('dropshipping/cart/payment/cb');
         Route::get('/dropshipping/cart/payment/cb/error', [CartController::class, 'redirect_cb_error_drop'])->name('dropshipping/cart/payment/cb/error');
         Route::get('/dropshipping/cart/validation', [CartController::class, 'create_adresses_validation_drop'])->name('dropshipping/cart/validation');
         Route::post('/dropshipping/cart/validation/order', [CartController::class, 'confirmation_order_clients_drop'])->name('dropshipping/cart/validation/order');
      });
   });

   Route::get('/shippings', [ShippingsController::class, 'create'])->name('shippings');
   Route::post('/shippings/panier/edit', [ShippingsController::class, 'edit_panier'])->name('shippings/panier/edit');
   Route::post('/shippings/panier/delete', [ShippingsController::class, 'delete_commande'])->name('shippings/panier/delete');
   Route::post('/shippings/edit', [ShippingsController::class, 'edit_commande'])->name('shippings/edit');
   Route::post('/shippings/delete', [ShippingsController::class, 'delete_commande'])->name('shippings/delete');  
   Route::post('/shippings/order/clients/{num_commande}/products', [ShippingsController::class, 'get_order_client'])->name('shippings/order/clients/{num_commande}/products');
   Route::get('/shippings/order/clients/{num_commande}', [ShippingsController::class, 'create_order'])->name('shippings/order/clients/{num_commande}');
   Route::get('/shippings/order/clients/{num_commande}/visuel', [ShippingsController::class, 'get_visuel_order_zip'])->name('shippings/order/clients/{num_commande}/visuel');
   Route::get('/shippings/order/clients/{num_commande}/pdf/facture', [PDFController::class, 'generatePDF_facture'])->name('shippings/order/clients/{num_commande}/pdf/facture');
   Route::get('/shippings/order/clients/{num_commande}/pdf/proforma', [PDFController::class, 'generatePDF_proforma'])->name('shippings/order/clients/{num_commande}/pdf/proforma');
});

Route::get('language/{language}', function ($language) {
   Session::put('locale', $language);
   return true;
})->name('language');

Route::get('/cart/validation/payment', [CartController::class, 'confirmation_payment'])->name('cart/validation/payment');
Route::post('/cart/validation/payment', [CartController::class, 'confirmation_payment'])->name('cart/validation/payment');

require __DIR__.'/auth.php';
