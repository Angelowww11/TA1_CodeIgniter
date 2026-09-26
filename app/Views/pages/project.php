<?= view('partials/app_header', ['title' => $title]) ?>

<section class="page-intro" aria-labelledby="about-title">
    <p class="kicker">About the system</p>
    <div class="page-intro-grid">
        <h1 id="about-title">A focused view of daily work.</h1>
        <p>Tasks for Today is a CodeIgniter 4 project developed by Angelo Kacey N. Pineda of section TW33. It separates routing, controllers, models, and views while using MySQL as a shared data source.</p>
    </div>
</section>

<section class="content-section architecture" aria-labelledby="architecture-title">
    <div class="section-heading">
        <div><p class="kicker">Application flow</p><h2 id="architecture-title">How the parts connect</h2></div>
    </div>
    <div class="flow-grid">
        <article><span>Route</span><h3>Direct the request</h3><p>Four defined URLs connect visitors to the correct controller method.</p></article>
        <article><span>Controller</span><h3>Prepare the page</h3><p>Controllers request the correct records and pass clean data to each view.</p></article>
        <article><span>Model</span><h3>Query MySQL</h3><p>TaskModel and UserModel keep database access reusable and organized.</p></article>
        <article><span>View</span><h3>Present the result</h3><p>Responsive views escape every displayed value and explain empty states clearly.</p></article>
    </div>
</section>

<?= view('partials/app_footer') ?>
