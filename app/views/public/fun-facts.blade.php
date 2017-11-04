<section id="osvit-counters" data-stellar-background-ratio="0.5">
    <div class="osvit-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 section-heading text-center to-animate">
                <h2>{{ getenv('WEB_NAME') }} u brojevima</h2>
            </div>
        </div>
        <div class="row">
            @foreach($fun_facts_data as $fact)
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="osvit-counter to-animate">
                        <i class="{{ $fact->info_icon }} red to-animate-2"></i>
                        <span class="osvit-counter-number js-counter" data-from="0" data-to="{{ $fact->info_number }}" data-speed="2500" data-refresh-interval="50">{{ $fact->info_number }}</span>
                        <span class="osvit-counter-label">{{ $fact->info_title }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>