<footer id="footer" role="contentinfo">
    <div class="container">
        <div class="copyright">
            <div class="col-md-12 text-center">
                <p>&copy; <b>{{ getenv('WEB_NAME') }}</b>, {{ date('Y') }} | Made with <i class="fa fa-heart pulseAnim red" title="love"></i>  by <a href="{{ url('https://github.com/gek0') }}" target="_blank">Matija</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-social social-item-facebook">
                        <a href="{{ getenv('FACEBOOK_URL') }}" target="_blank">
                            <i class="fa fa-facebook-official fa-gig"></i>
                        </a>
                    </li>
                    <li class="list-group-item list-group-item-social social-item-youtube">
                        <a href="{{ getenv('YOUTUBE_URL') }}" target="_blank">
                            <i class="fa fa-youtube fa-gig"></i>
                        </a>
                    </li>
                    <li class="list-group-item list-group-item-social social-item-rss">
                        <a href="{{ route('rss') }}" target="_blank">
                            <i class="fa fa-rss fa-gig"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- scripts -->
{{ HTML::script('js/jquery.easing.1.3.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/jquery.waypoints.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/jquery.stellar.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/jquery.countTo.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/jquery.magnific-popup.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/magnific-popup-options.js', ['charset' => 'utf-8']) }}
{{ HTML::script('https://apis.google.com/js/platform.js', ['charset' => 'utf-8']) }}
{{ HTML::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyAq_DC0fNjXxqN-dTvo6PhN_ifxBvBcCWI', ['charset' => 'utf-8']) }}
{{ HTML::script('js/gmaps.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/main.js', ['charset' => 'utf-8']) }}

</body>
</html>
