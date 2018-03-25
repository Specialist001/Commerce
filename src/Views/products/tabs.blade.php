<div class="row raw-margin-bottom-24">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" {!! (request('tab') == 'details') || isset($tabs['details']) ? 'class="active"': '' !!}>
            <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/products/'.$product->id.'/edit?tab=details') !!}" role="tab">Details</a>
        </li>
        <li role="presentation" {!! (request('tab') == 'variants') ? 'class="active"': '' !!}>
            <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/products/'.$product->id.'/edit?tab=variants') !!}" role="tab">Variants</a>
        </li>
        @if ($product->is_download)
            <li role="presentation" {!! (request('tab') == 'download') ? 'class="active"': '' !!}>
                <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/products/'.$product->id.'/edit?tab=download') !!}" role="tab">Download</a>
            </li>
        @else
            <li role="presentation" {!! (request('tab') == 'dimensions') ? 'class="active"': '' !!}>
                <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/products/'.$product->id.'/edit?tab=dimensions') !!}" role="tab">Dimensions</a>
            </li>
        @endif
        <li role="presentation" {!! (request('tab') == 'discount') ? 'class="active"': '' !!}>
            <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/products/'.$product->id.'/edit?tab=discount') !!}" role="tab">Discounts</a>
        </li>
        <li role="presentation" {!! (request('tab') == 'images') ? 'class="active"': '' !!}>
            <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/products/'.$product->id.'/edit?tab=images') !!}" role="tab">Images</a>
        </li>
    </ul>
</div>

@if ((request('tab') == 'details') || isset($tabs['details']))
    @include('commerce::products.tabs.details')
@endif

@if (request('tab') == 'variants')
    @include('commerce::products.tabs.variants')
@endif

@if (request('tab') == 'discount')
    @include('commerce::products.tabs.discount')
@endif

@if (request('tab') == 'download')
    @include('commerce::products.tabs.download')
@endif

@if (request('tab') == 'dimensions')
    @include('commerce::products.tabs.dimensions')
@endif

@if (request('tab') == 'images')
    @include('commerce::products.tabs.images')
@endif
