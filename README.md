# AVRillo Code Test

## Setup

1. Clone this GitHub repository into your desired location.
2. Ensure you have the minimum requirements for Laravel 11.
3. Run `composer install` inside the directory.
4. Once completed, run `php artisan serve` to access the API through your localhost or use another service such as Apache.
5. You can now access the API by the defined domain.

## Endpoints

| Endpoint | Description | Request Headers |
| -------- | ------- | ------- |
| `/v1/generate-token` | Generate a short-lived token in order to authenticate into the API. | Accept: `application/json` | 
| `/v1/quotes` | Display a list of Kayne West quotes. | Accept: `application/json`<br />Authorization: `Bearer {token}` |

## Tests

Feature tests have been created for the 2 existing endpoints and can be ran using the `php artisan test` command.
