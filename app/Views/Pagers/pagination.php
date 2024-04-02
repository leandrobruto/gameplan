<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav aria-label="Page navigation">
    <ul class="pagination">
    <?php if ($pager->hasPrevious()) : ?>
        <li class="page-item first">
            <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                <span class="tf-icon bx bx-chevrons-left" aria-hidden="true"></span>
            </a>
        </li>
        <li class="page-item prev">
            <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
                <span class="tf-icon bx bx-chevron-left" aria-hidden="true"></span>
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link): ?>
        <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
            <a class="page-link" href="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <li class="page-item next">
            <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
                <span class="tf-icon bx bx-chevron-right" aria-hidden="true"></span>
            </a>
        </li>
        <li class="page-item last">
            <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                <span class="tf-icon bx bx-chevrons-right" aria-hidden="true"></span>
            </a>
        </li>
    <?php endif ?>
    </ul>
</nav>