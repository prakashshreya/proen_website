<?php

include 'search_data.php';

$query = strtolower(trim($_GET['q'] ?? ''));

foreach ($pages as $page) {

    $text = strtolower($page['title'] . ' ' . $page['content'] . ' ' . implode(' ', $page['keywords']));

    if (strpos($text, $query) !== false) {

        echo '
        <div class="search-item">
            <a href="'.$page['url'].'">'.$page['title'].'</a>
            <p>'.$page['content'].'</p>
        </div>';
    }
}