# CHANGELOG

## [0.4.x (Unreleased)](https://github.com/onlime/bexio-api-client/compare/0.3.1...main)

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
