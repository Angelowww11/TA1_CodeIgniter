# TFA4 access control evidence

Verified locally on 5 October 2026 with the existing five customers and five users.

- Logged-out requests to `/`, `/customers`, `/customers/new`, `/customers/edit/1`, `/users`, `/users/new`, and `/users/edit/1` redirected to `/login`.
- Incorrect passwords and the inactive sample account were rejected.
- An active account signed in successfully and reached both listings and all create/edit pages.
- The user edit form remained prefilled after authentication.
- POST logout returned to login, and subsequent protected requests were blocked.
- Route inspection confirmed the authentication filter on all customer/user GET and POST routes, with automatic routing disabled.

The six `tfa4-*.png` screenshots record the redirect, error, authenticated listings/edit form, and logout confirmation. The DOCX submission remains local in `submission/`.
