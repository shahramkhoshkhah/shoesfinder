<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("inc/data.php");
include("inc/functions.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    /*if (isset($catalog[$id])) {
        $item = $catalog[$id];
    }*/
}

/*if (!isset($item)) {
    header("location:catalog.php");
    exit;
}*/

try {
   $results = $db->prepare("SELECT id, title, category_id, img, color, size, price FROM items WHERE id=?");
   $results->bindParam(1, $id);
   $results->execute();
   $items = $results->fetchAll();
} catch (Exception $e) {
   echo "Unable to retrieved results";
   exit;
}

if (count($items) > 0) {
  $item = $items[0];
} else {
  echo "Unable to retrieve item results.";
  exit;
}

try {
   $results = $db->prepare("SELECT title FROM categories WHERE id=?");
   $results->bindParam(1, $item['category_id']);
   $results->execute();
   $categories = $results->fetchAll();
} catch (Exception $e) {
   echo "Unable to retrieved results";
   exit;
}

if (count($categories) > 0) {
  $category = $categories[0]['title'];
} else {
  echo "Unable to retrieve category results.";
  exit;
}

$pageTitle = $item["title"];
$section = null;

include("inc/header.php"); ?>

<div class="section page">

     <div class="wrapper">

         <div class="breadcrumbs">
           <a href="catalog.php">Full Catalog</a>
           &gt; <a href="catalog.php?cat=<?php echo strtolower($category); ?>">
           <?php echo $category; ?></a>
           &gt; <?php echo $item["title"]; ?>
         </div>

         <div class="media-picture">

       <span>
            <img src="<?php echo $item["img"]; ?>" alt="<?php echo $item["title"]; ?>" />
       </span>

       </div>

       <div class="media-details">

           <h1><?php echo $item["title"]; ?></h1>
           <table>

               <tr>
                   <th>Category</th>
                   <td><?php echo $category; ?></td>
               </tr>
                <tr>
                   <th>Color</th>
                   <td><?php echo $item["color"]; ?></td>
               </tr>
                <tr>
                   <th>Size</th>
                   <td><?php echo $item["size"]; ?></td>
               </tr>
                <tr>
                   <th>Price</th>
                   <td><?php echo $item["price"]; ?></td>
               </tr>
               <?php if (strtolower($category) == "women") { ?>
               <?php } else if (strtolower($category) == "men") { ?>
               <?php } else if (strtolower($category) == "kids") { ?>
               <?php } ?>
           </table>
       </div>


  </div>
</div>
