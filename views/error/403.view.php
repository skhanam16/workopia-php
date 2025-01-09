<?php
// require loadView('head.php');
loadPartials("head");
loadPartials("navbar");


// require basePath('views/partials/navbar.php');
// require basePath('views/partials/showcase-search.php');
// require basePath('views/partials/top-banner.php');
?>
<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">403 Error</div>
        <p class="text-center text-2xl mb-4">
            You are not authorised to view this page
        </p>
    </div>
</section>

<?php


loadPartials("footer");

// require basePath('views/partials/bottom-banner.php');
// require basePath('views/partials/footer.php');
?>