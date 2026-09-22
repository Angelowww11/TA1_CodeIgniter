<?= view('partials/header', ['title' => $title]) ?>

<section class="hero">
    <p class="eyebrow">CodeIgniter POS Foundations</p>
    <h1>A simple starting point for a point-of-sale system</h1>
    <p>This project demonstrates routes, controllers, models, views, and persistent account records stored in MySQL.</p>
    <div class="actions">
        <a class="button" href="<?= site_url('customers') ?>">View customers</a>
        <a class="button secondary" href="<?= site_url('users') ?>">View users</a>
    </div>
</section>

<section class="card-grid" aria-label="Project pages">
    <article class="card">
        <span class="card-number">01</span>
        <h2>Customer Accounts</h2>
        <p>See customer names, email addresses, and phone numbers.</p>
    </article>
    <article class="card">
        <span class="card-number">02</span>
        <h2>User Accounts</h2>
        <p>See staff usernames, full names, and assigned roles.</p>
    </article>
    <article class="card">
        <span class="card-number">03</span>
        <h2>About the Project</h2>
        <p>Learn how the routes, controllers, and views work together.</p>
    </article>
</section>

<?= view('partials/footer') ?>
