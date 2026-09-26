<?= view('partials/app_header', ['title' => $title]) ?>

<section class="page-heading" aria-labelledby="about-title">
    <p class="eyebrow">About the system</p>
        <h1 id="about-title">A focused view of daily work.</h1>
        <p>Tasks for Today is a CodeIgniter 4 project developed by Angelo Kacey N. Pineda of section TW33. It separates routing, controllers, models, and views while using MySQL as a shared data source.</p>
</section>

<section aria-labelledby="architecture-title">
    <h2 id="architecture-title">How the parts connect</h2>
    <div class="steps">
        <article class="card"><span class="card-number">01 / ROUTES</span><h2>Direct the request</h2><p>Four defined URLs connect visitors to the correct controller method.</p></article>
        <article class="card"><span class="card-number">02 / CONTROLLERS</span><h2>Prepare the page</h2><p>Controllers request the correct records and pass clean data to each view.</p></article>
        <article class="card"><span class="card-number">03 / MODELS</span><h2>Query MySQL</h2><p>TaskModel and UserModel keep database access reusable and organized.</p></article>
    </div>
</section>

<?= view('partials/app_footer') ?>
