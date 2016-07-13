<?php
include("inc/data.php");
include("inc/functions.php");

$pageTitle = "Full Catalog";
$section = null;

if (isset($_GET["cat"])) {
    if ($_GET["cat"] == "women") {
      $pageTitle = "Women";
      $section = "women";
    } else if ($_GET["cat"] == "men") {
      $pageTitle = "Men";
      $section = "men";
    } else if ($_GET["cat"] == "kids") {
      $pageTitle = "Kids";
      $section = "kids";
    }
}

try {
   $results = $db->prepare("SELECT id, title FROM catalogs WHERE title=?");
   $results->bindParam(1, $section);
   $results->execute();
   $r = $results->fetchAll();
   if (count($r) >= 1) {
     $catalog_id = $r[0]['id'];
   }
} catch (Exception $e) {
   echo "Unable to retrieved results";
   exit;
}

include("inc/header.php"); ?>

<div class="section catalog page">
    <div class="wrapper">

         <h1><?php
         if ($section != null) {
             echo "<a href='catalog.php'>Full Catalog</a> &gt; ";
         }
         echo $pageTitle; ?></h1>

        <ul class="items">
            <?php
            try {
               $results = $db->prepare("SELECT id, title, category_id, img FROM items WHERE catalog_id=?");
               $results->bindParam(1, $catalog_id);
               $results->execute();
               $catalogs = $results->fetchAll();
            } catch (Exception $e) {
               echo "Unable to retrieved results";
               exit;
            }

            //var_dump($catalogs);

            //var_dump($catalog);

            //$categories = array_category($catalog,$section);
            //var_dump($catalogs);

            /*foreach ($catalogs as $item) {
              $category = $item['category'];
              echo $category;
            }*/
            foreach($catalogs as $catalog) {
                echo get_item_html($catalog['id'],$catalog);
            }
           ?>
        </ul>

    </div>
</div>

<?php include("inc/footer.php"); ?>
