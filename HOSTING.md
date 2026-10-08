# Deploying SimplePOS on Vercel

SimplePOS runs on Vercel through the community PHP runtime and uses PostgreSQL from the Neon Marketplace integration. The app keeps sessions and uploaded product/staff images in PostgreSQL because Vercel function files are temporary between invocations.

## Prepare the project

1. Create a Neon PostgreSQL database through Vercel Marketplace and connect it to the Vercel project for Production, Preview, and Development. The project reads `DATABASE_URL`.
2. Add `POS_ADMIN_PASSWORD` as a private environment variable in Vercel. Use at least 12 characters. The first deployment creates `admin01` only if the staff table is empty; login with this account and password.
3. Set `APP_BASE_URL` to the assigned HTTPS domain, including the trailing slash, such as `https://your-project.vercel.app/`.
4. Deploy the repository's `main` branch. The Composer `vercel` build script runs migrations and seeds the initial admin and catalog. Vercel routes requests through `api/index.php` to CodeIgniter.
5. After deployment, verify login, products and image upload, customers, staff, sales, stock updates, and sales history. Check the Vercel deployment logs if database migration or build initialization fails.

## Notes

- The Neon connection URL must be available as `DATABASE_URL`; keep it private and do not commit it.
- The app enables secure cookies on Vercel and stores sessions in the `ci_sessions` table.
- Product images and staff avatars are stored in PostgreSQL in the `uploaded_media` table. Image data is kept in the database so it persists across deployments.
- The GitHub repository excludes `.env` files, Vercel project metadata, writable data, and assessment documents.
- Vercel provides PHP through a community runtime. Confirm its current runtime and function limits when changing deployment settings.
