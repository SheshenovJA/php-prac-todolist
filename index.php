<?php
  require_once 'app/init.php';

  $itemsQuery = $db->prepare("
    SELECT id, name, done
    FROM items
    WHERE user = :user
  ");

  $itemsQuery->execute([
    'user' => $_SESSION['user_id']
  ]);

  $items = $itemsQuery->rowCount() ? $itemsQuery : [];

//foreach ($items as $item) {
  //echo $item['name'];

  //}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>to do list</title>
    <link rel="stylesheet" href="styles/main.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  </head>
  <body>
    <div class="list">
        <h1 class="header">To do</h1>

        <?php
          if (!empty($items)): ?>
        <ul class="items">
          <?php foreach ($items as $item): ?>
          <li>
              <span class="item<?php echo $item['done'] ? ' done' : ''?>"><?php
                echo $item['name'];
              ?></span>
              <?php if(!$item['done']):?>
              <a href="mark.php?as=done&item=<?php echo $item['id']; ?>" class="done-button">mark as done</a>
            <?php endif;?>
          </li>
        <?php endforeach;?>
          <li>
              <span class="item done">finished</span>
          </li>
        </ul>
<?php else: ?>
          <p>No items yet.</p>
      <?php endif;?>
        <form class="item-add" action="add.php" method="post">
          <input type="text" name="name" placeholder="Type a new item here" class="input" autocomplete="off" required>
          <input type="submit" value="add" class="submit">
        </form>


    </div>
  </body>
</html>
