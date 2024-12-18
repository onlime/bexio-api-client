# CHANGELOG

## [0.6.x (unreleased)](https://github.com/onlime/bexio-api-client/compare/0.6.2...main)

## [0.6.2 (2024-12-05)](https://github.com/onlime/bexio-api-client/compare/0.6.1...0.6.2)

- Fix token refresh for new Bexio OpenID Connect provider URL `https://auth.bexio.com/realms/bexio`: Always store scopes in tokens file, as they are also used in `refreshToken()`.
- Add `SensitiveParameter` attribute to all sensitive parameters to avoid logging/leaking them.

## [0.6.1 (2024-10-09)](https://github.com/onlime/bexio-api-client/compare/0.6.0...0.6.1)

- Fix for `jumbojett/openid-connect-php` v1.0: Only set accessToken if already loaded in `Bexio\Client` instance.

## [0.6.0 (2024-10-08)](https://github.com/onlime/bexio-api-client/compare/0.5.0...0.6.0)

- Updated `jumbojett/openid-connect-php` to v1.0
- Updated Bexio OpenID Connect provider URL to `https://auth.bexio.com/realms/bexio`

## [0.5.0 (2023-09-27)](https://github.com/onlime/bexio-api-client/compare/0.4.1...0.5.0)

- Added Bexio company profile endpoint request methods to `Other` resource.
- Drop PHP 8.0/8.1 support
- Integrated laravel/pint as dev requirement for PHP style fixing
- Using more return types

## [0.4.1 (2022-03-24)](https://github.com/onlime/bexio-api-client/compare/0.4.0...0.4.1)

- Extended `getFullApiUrl()` to optionally append query params.
- Added `onlime/laravel-bexio-api-client` to suggested packages to use this library with Laravel HTTP Client instead of Guzzle.

## [0.4.0 (2022-03-24)](https://github.com/onlime/bexio-api-client/compare/0.3.1...0.4.0)

- Fix release comparison links in CHANGELOG.
- Refactored most `Client` methods into `AbstractClient` for better extensibility.
- BC break: The redirect URL does now need to be passed as second argument of the `Client::authenticate($scopes, $redirectUrl)` method, no longer as constructor argument.

## [0.3.1 (2022-03-23)](https://github.com/onlime/bexio-api-client/compare/0.3.0...0.3.1)

- Fix `Contact::searchContacts()` to support query params.
- Use `query` request option in Guzzle client instead of appending query params to API URI directly to avoid conflicts with already existing query params in configured API URI.
- Fix phpDoc comments for `$id` method params.
- Add this CHANGELOG.

## [0.3.0 (2022-03-18)](https://github.com/onlime/bexio-api-client/compare/0.2.1...0.3.0)

- Implement Bexio API v3 support with OpenID Connect authentication.
- Detach fork from christianruhstaller/bexio-api-php-client, released as new package.

## [0.2.1 (2019-01-16)](https://github.com/onlime/bexio-api-client/compare/0.2.0...0.2.1)

- Add `createInvoicePayment` and `deleteInvoicePayment`

## [0.2.0 (2019-01-16)](https://github.com/onlime/bexio-api-client/compare/0.1.0...0.2.0)

- Update phpDoc for `getContacts` to reflect parameters

## [0.1.0 (2017-08-31)](https://github.com/onlime/bexio-api-client/releases/tag/0.1.0)

- Initial release
- Fix contacts search and add discount and invoice resources
