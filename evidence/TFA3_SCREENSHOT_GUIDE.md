# TFA3 Screenshot Evidence

The screenshots in `evidence/screenshots/` were captured from the running local CodeIgniter application and phpMyAdmin. They cover customer creation, validation, and editing; user creation, validation, and editing; avatar upload success and rejection; placeholder display; and the nullable avatar database column.

| File | What it shows |
| --- | --- |
| `tfa3-customer-list.png` | Customer account list and add action |
| `tfa3-customer-new.png` | New customer form |
| `tfa3-customer-validation.png` | Invalid email rejected with entered values retained |
| `tfa3-customer-edit.png` | Customer edit form prefilled from an existing record |
| `tfa3-customer-created.png` | Successful customer creation in the list |
| `tfa3-user-list-fallback.png` | User listing with placeholder avatars |
| `tfa3-user-new.png` | New user form |
| `tfa3-user-validation.png` | Invalid email rejected and entered account values redisplayed |
| `tfa3-user-edit.png` | User edit form and current avatar preview |
| `tfa3-avatar-upload-success.png` | Uploaded avatar displayed as a prepared thumbnail |
| `tfa3-avatar-upload-rejected.png` | Unsupported SVG image rejected with a validation message |
| `tfa3-database-avatar-column.png` | Nullable `avatar` column in the `user_accounts` table |

All test account records and the uploaded test image were removed after capture. Existing POS records were preserved. The database structure retains the required nullable avatar column. Screenshots are evidence of local behavior and do not provide a hosted application URL; hosting has not been configured.
