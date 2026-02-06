<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

```
resto
├─ .editorconfig
├─ app
│  ├─ Http
│  │  ├─ Controllers
│  │  │  ├─ Admin
│  │  │  │  ├─ DashboardController.php
│  │  │  │  ├─ MenuController.php
│  │  │  │  ├─ StoreMenuRequest.php
│  │  │  │  └─ UpdateMenuRequest.php
│  │  │  ├─ Auth
│  │  │  │  ├─ AuthenticatedSessionController.php
│  │  │  │  ├─ ConfirmablePasswordController.php
│  │  │  │  ├─ EmailVerificationNotificationController.php
│  │  │  │  ├─ EmailVerificationPromptController.php
│  │  │  │  ├─ NewPasswordController.php
│  │  │  │  ├─ PasswordController.php
│  │  │  │  ├─ PasswordResetLinkController.php
│  │  │  │  ├─ RegisteredUserController.php
│  │  │  │  └─ VerifyEmailController.php
│  │  │  ├─ Controller.php
│  │  │  ├─ Customer
│  │  │  │  ├─ CartController.php
│  │  │  │  └─ MenuController.php
│  │  │  ├─ Kasir
│  │  │  │  └─ DashboardController.php
│  │  │  └─ ProfileController.php
│  │  ├─ Middleware
│  │  │  └─ CheckUserRole.php
│  │  └─ Requests
│  │     ├─ Auth
│  │     │  └─ LoginRequest.php
│  │     ├─ ProfileUpdateRequest.php
│  │     ├─ StoreMenuRequest.php
│  │     └─ UpdateMenuRequest.php
│  ├─ Interfaces
│  │  └─ MenuRepositoryInterface.php
│  ├─ Models
│  │  ├─ Admin.php
│  │  ├─ Category.php
│  │  ├─ Kasir.php
│  │  ├─ Menu.php
│  │  ├─ MenuRecommendation.php
│  │  ├─ Order.php
│  │  ├─ OrderItem.php
│  │  ├─ RestaurantInfo.php
│  │  └─ User.php
│  ├─ Providers
│  │  └─ AppServiceProvider.php
│  ├─ Repositories
│  │  └─ MenuRepository.php
│  ├─ Traits
│  │  └─ HasRoles.php
│  └─ View
│     └─ Components
│        ├─ AppLayout.php
│        └─ GuestLayout.php
├─ artisan
├─ bootstrap
│  ├─ app.php
│  ├─ cache
│  │  ├─ packages.php
│  │  └─ services.php
│  └─ providers.php
├─ composer.json
├─ composer.lock
├─ config
│  ├─ app.php
│  ├─ auth.php
│  ├─ cache.php
│  ├─ database.php
│  ├─ filesystems.php
│  ├─ logging.php
│  ├─ mail.php
│  ├─ queue.php
│  ├─ services.php
│  └─ session.php
├─ database
│  ├─ database.sqlite
│  ├─ factories
│  │  └─ UserFactory.php
│  ├─ migrations
│  │  ├─ 0001_01_01_000000_create_users_table.php
│  │  ├─ 0001_01_01_000001_create_cache_table.php
│  │  ├─ 0001_01_01_000002_create_jobs_table.php
│  │  ├─ 2025_11_24_032826_add_role_to_users_table.php
│  │  ├─ 2025_11_24_033612_create_restaurant_info_table.php
│  │  ├─ 2025_11_24_033621_create_categories_table.php
│  │  ├─ 2025_11_24_033631_create_menus_table.php
│  │  ├─ 2025_11_24_033638_create_menu_recommendations_table.php
│  │  ├─ 2025_11_24_033646_create_orders_table.php
│  │  └─ 2025_11_24_033651_create_order_items_table.php
│  └─ seeders
│     ├─ CategorySeeder.php
│     ├─ DatabaseSeeder.php
│     ├─ MenuSeeder.php
│     ├─ RestaurantInfoSeeder.php
│     └─ UserSeeder.php
├─ package-lock.json
├─ package.json
├─ phpunit.xml
├─ postcss.config.js
├─ public
│  ├─ .htaccess
│  ├─ favicon.ico
│  ├─ index.php
│  └─ robots.txt
├─ README.md
├─ resources
│  ├─ css
│  │  └─ app.css
│  ├─ js
│  │  ├─ app.js
│  │  └─ bootstrap.js
│  └─ views
│     ├─ admin
│     │  ├─ dashboard.blade.php
│     │  └─ menus
│     │     ├─ create.blade.php
│     │     ├─ edit.blade.php
│     │     └─ index.blade.php
│     ├─ auth
│     │  ├─ confirm-password.blade.php
│     │  ├─ forgot-password.blade.php
│     │  ├─ login.blade.php
│     │  ├─ register.blade.php
│     │  ├─ reset-password.blade.php
│     │  └─ verify-email.blade.php
│     ├─ components
│     │  ├─ application-logo.blade.php
│     │  ├─ auth-session-status.blade.php
│     │  ├─ danger-button.blade.php
│     │  ├─ dropdown-link.blade.php
│     │  ├─ dropdown.blade.php
│     │  ├─ input-error.blade.php
│     │  ├─ input-label.blade.php
│     │  ├─ modal.blade.php
│     │  ├─ nav-link.blade.php
│     │  ├─ primary-button.blade.php
│     │  ├─ responsive-nav-link.blade.php
│     │  ├─ secondary-button.blade.php
│     │  └─ text-input.blade.php
│     ├─ customer
│     │  ├─ cart.blade.php
│     │  ├─ home.blade.php
│     │  └─ menu.blade.php
│     ├─ dashboard.blade.php
│     ├─ layouts
│     │  ├─ admin.blade.php
│     │  ├─ app.blade.php
│     │  ├─ customer.blade.php
│     │  ├─ guest.blade.php
│     │  └─ navigation.blade.php
│     ├─ profile
│     │  ├─ edit.blade.php
│     │  └─ partials
│     │     ├─ delete-user-form.blade.php
│     │     ├─ update-password-form.blade.php
│     │     └─ update-profile-information-form.blade.php
│     └─ welcome.blade.php
├─ routes
│  ├─ admin.php
│  ├─ auth.php
│  ├─ console.php
│  ├─ kasir.php
│  └─ web.php
├─ storage
│  ├─ app
│  │  ├─ private
│  │  └─ public
│  ├─ framework
│  │  ├─ cache
│  │  │  └─ data
│  │  ├─ sessions
│  │  ├─ testing
│  │  └─ views
│  │     ├─ 037ea860d2f2f62044054dbef8529f05.php
│  │     ├─ 03ca625055b2d6e05c80ce885d050ec7.php
│  │     ├─ 08eb18541f337f02b727903b6d2db849.php
│  │     ├─ 0fe9911dfd3ee8f7a0ac6b76e1d6817a.php
│  │     ├─ 1ab62808dee0d204e8a61ed21a2279d2.php
│  │     ├─ 1cce162ac04ed9907898df776ef93f8d.php
│  │     ├─ 22451ffd7ae5545c1311719281200470.php
│  │     ├─ 2c929d17547aae90166bd763c49e27e4.php
│  │     ├─ 2e98b0fca0d501e2835415e1767c68e1.php
│  │     ├─ 322d31e266cfae49eced9d39fc0553d0.php
│  │     ├─ 3bebea79d0dabe6432ff4c9aa4477e1a.php
│  │     ├─ 41eac9726386b027394778759ebecf6a.php
│  │     ├─ 45ba1b79639927018366157d6c41bfd9.php
│  │     ├─ 4bfa83d5e4edc19c2a616a54eb77a83f.php
│  │     ├─ 516cefec0387ba6f38c2f1b41f7b0628.php
│  │     ├─ 59760f83a7bf9f098d6cf1ba541215be.php
│  │     ├─ 64a99e470369123023b54ef24d6bc59b.php
│  │     ├─ 72edb3f5e23dd05d5503fd439305472d.php
│  │     ├─ 73ab9e3799d4f049ba2360367e23fd82.php
│  │     ├─ 780690040c207ffc780b075b70c8a235.php
│  │     ├─ 7a6ef7476a48c2b06fc0854baa8827ac.php
│  │     ├─ 7ddabde44224e9149132cd033285f8f3.php
│  │     ├─ 82bd9009d9170fa0282ec3a00fc13f9c.php
│  │     ├─ 845c20cbb801d44eea5df695a9ed2502.php
│  │     ├─ 8d4a0727ed5afbe3f984a2c12188452e.php
│  │     ├─ 90f1d2b5001c66acd22c3c7f0cf4ebcf.php
│  │     ├─ 98628006ade93865449bfd207356ad99.php
│  │     ├─ a7499bbb7eaa4361dbfcd25544bc7547.php
│  │     ├─ ac54a19bb393f885b10db972435a1fcf.php
│  │     ├─ ae5ae0e6edf957ccca86f2d3b831316e.php
│  │     ├─ af8f01466567b9b813285b4b0bfd9c90.php
│  │     ├─ bbf42244e45df58a08818421332a371c.php
│  │     ├─ beee16d69e44132fedb67bf0aab458b1.php
│  │     ├─ c93c5505d244b777bb0888a2e26a8156.php
│  │     ├─ d06354f90b9b25e1e17bb047c2cb09e5.php
│  │     ├─ d20bb234849d9bc8a3c837138e260664.php
│  │     ├─ d2991100dd48c4e9c5565436f287b94c.php
│  │     ├─ d4474710449bc31f87c30d668517f1d8.php
│  │     ├─ d58edcf31b217649bcc83a4baea6ef7c.php
│  │     ├─ d8ee9581c9efd188650f0d53db71bf32.php
│  │     ├─ dec79e81c3bf1a94d1ede244eaa9f868.php
│  │     ├─ ec88f572bf59a766e1a61910ea7a2a88.php
│  │     ├─ ecd1c0eeca66b4ee3bb20371477586f7.php
│  │     └─ f396ed62c3543db0e74dc735952b2727.php
│  └─ logs
├─ tailwind.config.js
├─ tests
│  ├─ Feature
│  │  ├─ Auth
│  │  │  ├─ AuthenticationTest.php
│  │  │  ├─ EmailVerificationTest.php
│  │  │  ├─ PasswordConfirmationTest.php
│  │  │  ├─ PasswordResetTest.php
│  │  │  ├─ PasswordUpdateTest.php
│  │  │  └─ RegistrationTest.php
│  │  ├─ ExampleTest.php
│  │  └─ ProfileTest.php
│  ├─ TestCase.php
│  └─ Unit
│     └─ ExampleTest.php
└─ vite.config.js

```
```
resto
├─ .editorconfig
├─ app
│  ├─ Http
│  │  ├─ Controllers
│  │  │  ├─ Admin
│  │  │  │  ├─ DashboardController.php
│  │  │  │  ├─ MenuController.php
│  │  │  │  ├─ StoreMenuRequest.php
│  │  │  │  └─ UpdateMenuRequest.php
│  │  │  ├─ Auth
│  │  │  │  ├─ AuthenticatedSessionController.php
│  │  │  │  ├─ ConfirmablePasswordController.php
│  │  │  │  ├─ EmailVerificationNotificationController.php
│  │  │  │  ├─ EmailVerificationPromptController.php
│  │  │  │  ├─ NewPasswordController.php
│  │  │  │  ├─ PasswordController.php
│  │  │  │  ├─ PasswordResetLinkController.php
│  │  │  │  ├─ RegisteredUserController.php
│  │  │  │  └─ VerifyEmailController.php
│  │  │  ├─ Controller.php
│  │  │  ├─ Customer
│  │  │  │  ├─ CartController.php
│  │  │  │  └─ MenuController.php
│  │  │  ├─ Kasir
│  │  │  │  └─ DashboardController.php
│  │  │  └─ ProfileController.php
│  │  ├─ Middleware
│  │  │  └─ CheckUserRole.php
│  │  └─ Requests
│  │     ├─ Auth
│  │     │  └─ LoginRequest.php
│  │     ├─ ProfileUpdateRequest.php
│  │     ├─ StoreMenuRequest.php
│  │     └─ UpdateMenuRequest.php
│  ├─ Interfaces
│  │  └─ MenuRepositoryInterface.php
│  ├─ Models
│  │  ├─ Admin.php
│  │  ├─ Category.php
│  │  ├─ Kasir.php
│  │  ├─ Menu.php
│  │  ├─ MenuRecommendation.php
│  │  ├─ Order.php
│  │  ├─ OrderItem.php
│  │  ├─ RestaurantInfo.php
│  │  └─ User.php
│  ├─ Providers
│  │  └─ AppServiceProvider.php
│  ├─ Repositories
│  │  └─ MenuRepository.php
│  ├─ Traits
│  │  └─ HasRoles.php
│  └─ View
│     └─ Components
│        ├─ AppLayout.php
│        └─ GuestLayout.php
├─ artisan
├─ bootstrap
│  ├─ app.php
│  ├─ cache
│  │  ├─ packages.php
│  │  └─ services.php
│  └─ providers.php
├─ composer.json
├─ composer.lock
├─ config
│  ├─ app.php
│  ├─ auth.php
│  ├─ cache.php
│  ├─ database.php
│  ├─ filesystems.php
│  ├─ logging.php
│  ├─ mail.php
│  ├─ queue.php
│  ├─ services.php
│  └─ session.php
├─ database
│  ├─ database.sqlite
│  ├─ factories
│  │  └─ UserFactory.php
│  ├─ migrations
│  │  ├─ 0001_01_01_000000_create_users_table.php
│  │  ├─ 0001_01_01_000001_create_cache_table.php
│  │  ├─ 0001_01_01_000002_create_jobs_table.php
│  │  ├─ 2025_11_24_032826_add_role_to_users_table.php
│  │  ├─ 2025_11_24_033612_create_restaurant_info_table.php
│  │  ├─ 2025_11_24_033621_create_categories_table.php
│  │  ├─ 2025_11_24_033631_create_menus_table.php
│  │  ├─ 2025_11_24_033638_create_menu_recommendations_table.php
│  │  ├─ 2025_11_24_033646_create_orders_table.php
│  │  └─ 2025_11_24_033651_create_order_items_table.php
│  └─ seeders
│     ├─ CategorySeeder.php
│     ├─ DatabaseSeeder.php
│     ├─ MenuSeeder.php
│     ├─ RestaurantInfoSeeder.php
│     └─ UserSeeder.php
├─ package-lock.json
├─ package.json
├─ phpunit.xml
├─ postcss.config.js
├─ public
│  ├─ .htaccess
│  ├─ favicon.ico
│  ├─ index.php
│  └─ robots.txt
├─ README.md
├─ resources
│  ├─ css
│  │  └─ app.css
│  ├─ js
│  │  ├─ app.js
│  │  └─ bootstrap.js
│  └─ views
│     ├─ admin
│     │  ├─ dashboard.blade.php
│     │  └─ menus
│     │     ├─ create.blade.php
│     │     ├─ edit.blade.php
│     │     └─ index.blade.php
│     ├─ auth
│     │  ├─ confirm-password.blade.php
│     │  ├─ forgot-password.blade.php
│     │  ├─ login.blade.php
│     │  ├─ register.blade.php
│     │  ├─ reset-password.blade.php
│     │  └─ verify-email.blade.php
│     ├─ components
│     │  ├─ application-logo.blade.php
│     │  ├─ auth-session-status.blade.php
│     │  ├─ danger-button.blade.php
│     │  ├─ dropdown-link.blade.php
│     │  ├─ dropdown.blade.php
│     │  ├─ input-error.blade.php
│     │  ├─ input-label.blade.php
│     │  ├─ modal.blade.php
│     │  ├─ nav-link.blade.php
│     │  ├─ primary-button.blade.php
│     │  ├─ responsive-nav-link.blade.php
│     │  ├─ secondary-button.blade.php
│     │  └─ text-input.blade.php
│     ├─ customer
│     │  ├─ cart.blade.php
│     │  ├─ home.blade.php
│     │  └─ menu.blade.php
│     ├─ dashboard.blade.php
│     ├─ layouts
│     │  ├─ admin.blade.php
│     │  ├─ app.blade.php
│     │  ├─ customer.blade.php
│     │  ├─ guest.blade.php
│     │  └─ navigation.blade.php
│     ├─ profile
│     │  ├─ edit.blade.php
│     │  └─ partials
│     │     ├─ delete-user-form.blade.php
│     │     ├─ update-password-form.blade.php
│     │     └─ update-profile-information-form.blade.php
│     └─ welcome.blade.php
├─ routes
│  ├─ admin.php
│  ├─ auth.php
│  ├─ console.php
│  ├─ kasir.php
│  └─ web.php
├─ storage
│  ├─ app
│  │  ├─ private
│  │  └─ public
│  ├─ framework
│  │  ├─ cache
│  │  │  └─ data
│  │  ├─ sessions
│  │  ├─ testing
│  │  └─ views
│  │     ├─ 037ea860d2f2f62044054dbef8529f05.php
│  │     ├─ 03ca625055b2d6e05c80ce885d050ec7.php
│  │     ├─ 08eb18541f337f02b727903b6d2db849.php
│  │     ├─ 0fe9911dfd3ee8f7a0ac6b76e1d6817a.php
│  │     ├─ 1ab62808dee0d204e8a61ed21a2279d2.php
│  │     ├─ 1cce162ac04ed9907898df776ef93f8d.php
│  │     ├─ 22451ffd7ae5545c1311719281200470.php
│  │     ├─ 2c929d17547aae90166bd763c49e27e4.php
│  │     ├─ 2e98b0fca0d501e2835415e1767c68e1.php
│  │     ├─ 322d31e266cfae49eced9d39fc0553d0.php
│  │     ├─ 3bebea79d0dabe6432ff4c9aa4477e1a.php
│  │     ├─ 41eac9726386b027394778759ebecf6a.php
│  │     ├─ 45ba1b79639927018366157d6c41bfd9.php
│  │     ├─ 4bfa83d5e4edc19c2a616a54eb77a83f.php
│  │     ├─ 516cefec0387ba6f38c2f1b41f7b0628.php
│  │     ├─ 59760f83a7bf9f098d6cf1ba541215be.php
│  │     ├─ 64a99e470369123023b54ef24d6bc59b.php
│  │     ├─ 72edb3f5e23dd05d5503fd439305472d.php
│  │     ├─ 73ab9e3799d4f049ba2360367e23fd82.php
│  │     ├─ 780690040c207ffc780b075b70c8a235.php
│  │     ├─ 7a6ef7476a48c2b06fc0854baa8827ac.php
│  │     ├─ 7ddabde44224e9149132cd033285f8f3.php
│  │     ├─ 82bd9009d9170fa0282ec3a00fc13f9c.php
│  │     ├─ 845c20cbb801d44eea5df695a9ed2502.php
│  │     ├─ 8d4a0727ed5afbe3f984a2c12188452e.php
│  │     ├─ 90f1d2b5001c66acd22c3c7f0cf4ebcf.php
│  │     ├─ 98628006ade93865449bfd207356ad99.php
│  │     ├─ a7499bbb7eaa4361dbfcd25544bc7547.php
│  │     ├─ ac54a19bb393f885b10db972435a1fcf.php
│  │     ├─ ae5ae0e6edf957ccca86f2d3b831316e.php
│  │     ├─ af8f01466567b9b813285b4b0bfd9c90.php
│  │     ├─ bbf42244e45df58a08818421332a371c.php
│  │     ├─ beee16d69e44132fedb67bf0aab458b1.php
│  │     ├─ c93c5505d244b777bb0888a2e26a8156.php
│  │     ├─ d06354f90b9b25e1e17bb047c2cb09e5.php
│  │     ├─ d20bb234849d9bc8a3c837138e260664.php
│  │     ├─ d2991100dd48c4e9c5565436f287b94c.php
│  │     ├─ d4474710449bc31f87c30d668517f1d8.php
│  │     ├─ d58edcf31b217649bcc83a4baea6ef7c.php
│  │     ├─ d8ee9581c9efd188650f0d53db71bf32.php
│  │     ├─ dec79e81c3bf1a94d1ede244eaa9f868.php
│  │     ├─ ec88f572bf59a766e1a61910ea7a2a88.php
│  │     ├─ ecd1c0eeca66b4ee3bb20371477586f7.php
│  │     └─ f396ed62c3543db0e74dc735952b2727.php
│  └─ logs
├─ tailwind.config.js
├─ tests
│  ├─ Feature
│  │  ├─ Auth
│  │  │  ├─ AuthenticationTest.php
│  │  │  ├─ EmailVerificationTest.php
│  │  │  ├─ PasswordConfirmationTest.php
│  │  │  ├─ PasswordResetTest.php
│  │  │  ├─ PasswordUpdateTest.php
│  │  │  └─ RegistrationTest.php
│  │  ├─ ExampleTest.php
│  │  └─ ProfileTest.php
│  ├─ TestCase.php
│  └─ Unit
│     └─ ExampleTest.php
└─ vite.config.js

```