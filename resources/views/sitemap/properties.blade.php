<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @if(!empty($data))
        @if($data['category']=='destinations')
            @if(!empty($data['parent']))
                @foreach ($data['row'] as $single)
                    <url>
                        <loc>{{url('/')}}/{{$data['parent']}}/{{ $single['slug'] }}</loc>
                        <lastmod>{{ $single['created'] }}</lastmod>
                        <changefreq>weekly</changefreq>
                        <priority>0.9</priority>
                    </url>
                @endforeach
            @else
                @foreach ($data['row'] as $single)
                    <url>
                        <loc>{{url('/')}}/{{ $single->slug }}</loc>
                        <lastmod>{{ $single->created }}</lastmod>
                        <changefreq>weekly</changefreq>
                        <priority>0.9</priority>
                    </url>
                @endforeach    
            @endif
        @elseif($data['category']=='channels')
            
            @if(!empty($data['parent']))
                @foreach ($data['row'] as $single)
                    @if($single['category_youtube_channel_url']!='')
                        <url>
                            <loc>{{url('/')}}/{{$data['parent']}}/{{ $single['slug'] }}</loc>
                            <lastmod>{{ $single['created'] }}</lastmod>
                            <changefreq>weekly</changefreq>
                            <priority>0.9</priority>
                        </url>
                    @endif
                @endforeach                    
            @endif  
        @elseif($data['category']=='pages')
            @if (!empty($data['row']))            
                @foreach ($data['row'] as $fmenu)
                    
                    @if(count($fmenu['childs']) > 0)
                        
                            @foreach ($fmenu['childs'] as $fmenu2)
                                <url>
                                    <loc>
                                        @if($fmenu2['menu_type'] =='external')
                                            {{ URL::to($fmenu2['url'])}} 
                                        @else 
                                            {{ URL::to($fmenu2['module'])}}
                                        @endif     
                                    </loc>
                                    <lastmod></lastmod>
                                    <changefreq>weekly</changefreq>
                                    <priority>0.9</priority>
                                </url>                            
                                
                            @endforeach
                        
                    @endif
                        
                @endforeach           
            @endif                  
        @else
            @if(!empty($data['parent']))
                @foreach ($data['row'] as $single)
                    <url>
                        <loc>{{url('/')}}/{{$data['parent']}}/{{ $single->slug }}</loc>
                        <lastmod>{{ $single->created }}</lastmod>
                        <changefreq>weekly</changefreq>
                        <priority>0.9</priority>
                    </url>
                @endforeach
            @else
                @foreach ($data['row'] as $single)
                    <url>
                        <loc>{{url('/')}}/{{ $single->slug }}</loc>
                        <lastmod>{{ $single->created }}</lastmod>
                        <changefreq>weekly</changefreq>
                        <priority>0.9</priority>
                    </url>
                @endforeach    
            @endif
        @endif
    @endif
</urlset>