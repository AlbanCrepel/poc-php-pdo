<h1>Home</h1>

<?php

// with pg_connect
//$query = pg_query($db, "select * from carburant");

//$results = pg_fetch_all($query)

// Uncomment to debug
// var_dump(pg_fetch_all($results));

/*
$stmt = $db->prepare('SELECT id, title, content, created_at FROM post WHERE id = :id');
$stmt->execute(['id' => 1]);
$row = $stmt->fetch(\PDO::FETCH_ASSOC);
$post = $row ? Post::fromArray($row) : null;
*/

$stmt = $db->query('SELECT id, title, description, user_id, created_at FROM posts');
$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

$posts = array_map(fn(array $row) => Post::fromArray($row), $rows);

?>

<ul>
    <?php
        foreach ($posts as $post){
            //echo '<li>' . $post["title"] . '</li>';
            echo '<li>' . $post->getTitle() . '</li>';
        }
    ?>
</ul>

<script>

    // get results from php and store it in a js variable
    const results = <?php echo json_encode($posts); ?>

</script>
