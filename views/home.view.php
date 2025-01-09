<?php
// require loadView('head.php');
loadPartials("head");
loadPartials("navbar");
loadPartials("showcase-search");
loadPartials("top-banner");
// inspect($listings);

// require basePath('views/partials/navbar.php');
// require basePath('views/partials/showcase-search.php');
// require basePath('views/partials/top-banner.php');
?>
<!-- Job Listings -->
<section>

    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Recent Jobs</div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Job Listing 1: Software Engineer -->
            <?php foreach ($listings as $post): ?>
                <div class="rounded-lg shadow-md bg-white">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold"><?= $post->title ?></h2>
                        <p class="text-gray-700 text-lg mt-2">
                            <?= $post->description ?>
                        </p>
                        <ul class="my-4 bg-gray-100 p-4 rounded">
                            <li class="mb-2"><strong>Salary:</strong> <?= formatSalary($post->salary) ?></li>
                            <li class="mb-2">
                                <strong>Location: </strong><?= $post->company ?></h2>
                                <span
                                    class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">Local</span>
                            </li>
                            <li class="mb-2">
                                <strong>Tags:</strong> <span><?= $post->tags ?></span>,
                                <span>Coding</span>
                            </li>
                        </ul>
                        <a href="/listings/<?= $post->id ?>"
                            class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                            Details
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>
    <a href="/listings" class="block text-xl text-center">
        <i class="fa fa-arrow-alt-circle-right"></i>
        Show All Jobs
    </a>
</section>



<?php

loadPartials("bottom-banner");
loadPartials("footer");

// require basePath('views/partials/bottom-banner.php');
// require basePath('views/partials/footer.php');
?>