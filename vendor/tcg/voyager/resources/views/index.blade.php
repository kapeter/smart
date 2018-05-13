@extends('voyager::master')

@section('content')
    <div class="page-content">
        @include('voyager::alerts')
        @include('voyager::dimmers')
        <div class="analytics-container">
            <?php $google_analytics_client_id = Voyager::setting("admin.google_analytics_client_id"); ?>
            @if (isset($google_analytics_client_id) && !empty($google_analytics_client_id))
                {{-- Google Analytics Embed --}}
                <div id="embed-api-auth-container"></div>
            @else
                <p style="border-radius:4px; padding:20px; background:#fff; margin:0; color:#999; text-align:center;">
                    {!! __('voyager::analytics.no_client_id') !!}
                    <a href="https://console.developers.google.com" target="_blank">https://console.developers.google.com</a>
                </p>
            @endif

            <div class="Dashboard Dashboard--full" id="analytics-dashboard">
                <header class="Dashboard-header">
                    <ul class="FlexGrid">
                        <li class="FlexGrid-item">
                            <div class="Titles">
                                <h1 class="Titles-main" id="view-name">{{ __('voyager::analytics.select_view') }}</h1>
                                <div class="Titles-sub">{{ __('voyager::analytics.various_visualizations') }}</div>
                            </div>
                        </li>
                        <li class="FlexGrid-item FlexGrid-item--fixed">
                            <div id="active-users-container"></div>
                        </li>
                    </ul>
                    <div id="view-selector-container"></div>
                </header>

                <ul class="FlexGrid FlexGrid--halves">
                    <li class="FlexGrid-item">
                        <div class="Chartjs">
                            <header class="Titles">
                                <h1 class="Titles-main">{{ __('voyager::analytics.this_vs_last_week') }}</h1>
                                <div class="Titles-sub">{{ __('voyager::analytics.by_users') }}</div>
                            </header>
                            <figure class="Chartjs-figure" id="chart-1-container"></figure>
                            <ol class="Chartjs-legend" id="legend-1-container"></ol>
                        </div>
                    </li>
                    <li class="FlexGrid-item">
                        <div class="Chartjs">
                            <header class="Titles">
                                <h1 class="Titles-main">{{ __('voyager::analytics.this_vs_last_year') }}</h1>
                                <div class="Titles-sub">{{ __('voyager::analytics.by_users') }}</div>
                            </header>
                            <figure class="Chartjs-figure" id="chart-2-container"></figure>
                            <ol class="Chartjs-legend" id="legend-2-container"></ol>
                        </div>
                    </li>
                    <li class="FlexGrid-item">
                        <div class="Chartjs">
                            <header class="Titles">
                                <h1 class="Titles-main">{{ __('voyager::analytics.top_browsers') }}</h1>
                                <div class="Titles-sub">{{ __('voyager::analytics.by_pageview') }}</div>
                            </header>
                            <figure class="Chartjs-figure" id="chart-3-container"></figure>
                            <ol class="Chartjs-legend" id="legend-3-container"></ol>
                        </div>
                    </li>
                    <li class="FlexGrid-item">
                        <div class="Chartjs">
                            <header class="Titles">
                                <h1 class="Titles-main">{{ __('voyager::analytics.top_countries') }}</h1>
                                <div class="Titles-sub">{{ __('voyager::analytics.by_sessions') }}</div>
                            </header>
                            <figure class="Chartjs-figure" id="chart-4-container"></figure>
                            <ol class="Chartjs-legend" id="legend-4-container"></ol>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@stop