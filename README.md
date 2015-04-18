# Pagination

```php
$pagination = new Pagination();

$pagination->setCurrentPage(1)
    ->setMaxPerPage(10)
    ->setMaxPerViewPage(5)
    ->setUriString('stories/')
    ->setTotalCount(500);

print($pagination->render());
```

Gives output:

```php
<li><a class="active">1</a></li>
<li><a href="/stories/page/2/">2</a></li>
<li><a href="/stories/page/3/">3</a></li>
<li><a href="/stories/page/4/">4</a></li>
<li><a href="/stories/page/5/">5</a></li>
<li><a href="/stories/page/2/">Next</a></li>
<li><a href="/stories/page/50/">End</a></li>
```
