<?php
use Webup\LaravelTools\Breadcrumb\Facades\Breadcrumb;

?>
<ol itemscope itemtype="http://schema.org/BreadcrumbList">
    @foreach (Breadcrumb::items() as $i => $item)
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="{{ $item->url }}">
        <span itemprop="name">{{ $item->title }}</span></a>
        <meta itemprop="position" content="{{ $i++ }}" />
    </li>
    @endforeach
</ol>
