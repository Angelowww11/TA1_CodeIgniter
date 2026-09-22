<?= view('partials/header', ['title' => $title]) ?>

<section class="page-heading">
    <p class="eyebrow">About</p>
    <h1>How this beginner project works</h1>
    <p>SimplePOS is a four-page CodeIgniter application that uses Models and Query Builder to retrieve account records from MySQL.</p>
</section>

<section class="steps">
    <article class="card">
        <span class="card-number">1</span>
        <h2>Route</h2>
        <p>A URL such as <code>/customers</code> is connected to a controller method in <code>Routes.php</code>.</p>
    </article>
    <article class="card">
        <span class="card-number">2</span>
        <h2>Model and Controller</h2>
        <p>The Model represents a database table, while the controller retrieves its records and prepares the page data.</p>
    </article>
    <article class="card">
        <span class="card-number">3</span>
        <h2>View</h2>
        <p>The view receives the database records and turns them into escaped HTML table rows.</p>
    </article>
</section>

<?= view('partials/footer') ?>
