<?php
$categories = [
    1 => ['id' => 1, 'parent_id' => 0, 'name' => "Sport"],
    2 => ['id' => 2, 'parent_id' => 6, 'name' => "Ragtime"],
    3 => ['id' => 3, 'parent_id' => 0, 'name' => "Art"],
    4 => ['id' => 4, 'parent_id' => 1, 'name' => "Summer Sports"],
    5 => ['id' => 5, 'parent_id' => 8, 'name' => "Ski"],
    6 => ['id' => 6, 'parent_id' => 9, 'name' => "Jazz"],
    7 => ['id' => 7, 'parent_id' => 4, 'name' => "Basketball"],
    8 => ['id' => 8, 'parent_id' => 1, 'name' => "Winter Sports"],
    9 => ['id' => 9, 'parent_id' => 3, 'name' => "Music"],
    10 => ['id' => 10, 'parent_id' => 6, 'name' => "Swing"],
    11 => ['id' => 11, 'parent_id' => 9, 'name' => "Rock"],
    12 => ['id' => 12, 'parent_id' => 4, 'name' => "Football"],
    13 => ['id' => 13, 'parent_id' => 9, 'name' => "Blues"],
    14 => ['id' => 14, 'parent_id' => 3, 'name' => "Theatre"],
    15 => ['id' => 15, 'parent_id' => 8, 'name' => "Bobsleigh"],
];
function buildTree(array $categories,$parentId=null){
    $branch=[];
    foreach ($categories as $category){
        if($category['parent_id']==$parentId){
            $children=buildTree($categories,$category['id']);
            if ($children){
                $category['children']=$children;
            }
            $branch[]=$category;
        }
    }
    return $branch;
}
$tree=buildTree($categories);
function renderNode($node)
{
    echo "<li>";
    echo $node['name'];
    if (isset($node['children'])) {
        echo "<ul>";
        foreach ($node['children'] as $child) {
            renderNode($child);
        }
        echo "</ul>";
    }
    echo "</li>";
}

?>

<ul>
    <?php foreach ($tree as $treeItem): ?>
        <?php renderNode($treeItem); ?>
    <?php endforeach; ?>
</ul>

