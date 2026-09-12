<?= view('partials/header', ['title' => $title]) ?>

<section class="page-heading">
    <p class="eyebrow">About</p>
    <h1>How this beginner project works</h1>
    <p>SimplePOS is a four-page CodeIgniter application built to practice the MVC request flow before adding a database.</p>
</section>

<section class="steps">
    <article class="card">
        <span class="card-number">1</span>
        <h2>Route</h2>
        <p>A URL such as <code>/customers</code> is connected to a controller method in <code>Routes.php</code>.</p>
    </article>
    <article class="card">
        <span class="card-number">2</span>
        <h2>Controller</h2>
        <p>The controller prepares the page title and its temporary array of records.</p>
    </article>
    <article class="card">
        <span class="card-number">3</span>
        <h2>View</h2>
        <p>The view receives the data and turns it into the HTML shown in the browser.</p>
    </article>
</section>

<?= view('partials/footer') ?>
