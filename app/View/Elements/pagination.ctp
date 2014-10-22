<?php
$paginator = $this->Paginator;
?>
<div class="paging">
    <?php
    // the 'first' page button
    echo $paginator->first("First");
    // 'prev' page button,
    // we can check using the paginator hasPrev() method if there's a previous page
    // save with the 'next' page button
    if ($paginator->hasPrev()) {
        echo $paginator->prev("Prev");
    }
    // the 'number' page buttons
    echo $paginator->numbers(array('modulus' => 2));
    // for the 'next' button
    if ($paginator->hasNext()) {
        echo $paginator->next("Next");
    }
    // the 'last' page button
    echo $paginator->last("Last");
    ?>
</div>