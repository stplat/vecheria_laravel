<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>{{ url('') }}</loc>
    <lastmod>2020-02-25</lastmod>
    <changefreq>weekly</changefreq>
    <priority>1</priority>
  </url>
  <url>
    <loc>{{ url('shipping') }}</loc>
    <lastmod>2020-02-25</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc>{{ url('payment') }}</loc>
    <lastmod>2020-02-25</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc>{{ url('contacts') }}</loc>
    <lastmod>2020-02-25</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
  </url>
  @foreach ($items as $item)
    <url>
      <loc>{{ url('catalog/' . $item->category_slug . '/' . $item->slug) }}</loc>
      <lastmod>{{ substr($item->updated_at, '0', '10') }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.9</priority>
    </url>
  @endforeach
  @foreach ($categories as $category)
    <url>
      <loc>{{ url('catalog/' . $category->slug) }}</loc>
      <lastmod>{{ substr($category->updated_at, '0', '10') }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>1</priority>
    </url>
  @endforeach
</urlset>