<?php
    $presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
    $trans = $environment->getTranslator();
    if ($paginator->getLastPage() > 1):
        /* How many pages need to be shown before and after the current page */
        $showBeforeAndAfter = 3;
        /* Current Page */
        $currentPage = $paginator->getCurrentPage();
        $lastPage = $paginator->getLastPage();
        /* Check if the pages before and after the current really exist */
        $start = $currentPage - $showBeforeAndAfter;
        /*
            Check if first page in pagination goes below 1, and substract that from
            $showBeforeAndAfter var so the pagination won't start with page 0 or below
        */
        if($start < 1)
        {
            $diff = $start - 1;
            $start = $currentPage - ($showBeforeAndAfter + $diff);
        }
        $end = $currentPage + $showBeforeAndAfter;
        if($end > $lastPage)
        {
            $diff = $end - $lastPage;
            $end = $end - $diff;
        }
?>

<div class="pager">
    <div class="puls previous">
        <?php echo $presenter->getPrevious('&larr; 前一页'); ?>
    </div>
    <ul class="pagination">
        <?php echo $presenter->getPageRange($start, $end); ?>
    </ul>
    <div class="puls next">
        <?php echo $presenter->getNext('后一页 &rarr;'); ?>
    </div>
</div>

<?php endif; ?>