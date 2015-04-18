# Pagination

$pagination = new Pagination();

$pagination->setCurrentPage(1)
    ->setMaxPerPage(10)
    ->setMaxPerViewPage(5)
    ->setUriString('stories/')
    ->setTotalCount(500);

print($pagination->render());
