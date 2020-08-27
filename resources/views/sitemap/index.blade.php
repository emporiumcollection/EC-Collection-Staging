<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($allsitemap as $key)
        <sitemap>
            <loc>{{url('/')}}/sitemap/{{$key}}.xml</loc>
        </sitemap> 
    @endforeach   
</sitemapindex>