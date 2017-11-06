<section id="osvit-contact" data-section="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12 section-heading text-center">
                <h2 class="to-animate">Kontaktirajte nas</h2>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 subtext to-animate">
                        <h3>Za sve upite ili nejasnoće, kontaktirajte nas preko kontakt forme ili navedenih informacija sa strane.</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-bottom-padded-md">
            <div class="col-md-6 to-animate">
                <h3>Kontakt informacije</h3>
                <ul class="osvit-contact-info">
                    <li class="osvit-contact-info-sec"><i class="fa fa-home fa-big"></i> {{ getenv('OWNER_CONTACT_ADDRESS') }}</li>
                    <li class="osvit-contact-info-sec"><i class="fa fa-phone fa-big"></i> {{ getenv('OWNER_CONTACT_PHONE') }}</li>
                    <li class="osvit-contact-info-sec"><i class="fa fa-envelope fa-big"></i> {{ HTML::email(getenv('OWNER_CONTACT_EMAIL')) }}</li>
                    <li class="osvit-contact-info-sec"><i class="fa fa-facebook-official fa-big"></i> <a href="{{ getenv('FACEBOOK_URL') }}" target="_blank"> Taekwondo Team Osvit</a></li>
                </ul>

                <hr>

                <div class="social-section">
                    <!-- facebook SDK container -->
                    <div class="fb-page" data-href="{{ getenv('FACEBOOK_URL') }}" data-tabs="timeline" data-width="500" data-height="70" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true">
                        <blockquote cite="{{ getenv('FACEBOOK_URL') }}" class="fb-xfbml-parse-ignore">
                            <a href="{{ getenv('FACEBOOK_URL') }}">{{ getenv('WEB_NAME') }}</a>
                        </blockquote>
                    </div>

                    <!-- youtube SDK container -->
                    <div class="yt-page">
                        <div class="g-ytsubscribe" data-channelid="UCaqPIGqrp6eIqnDZbDzlVUw" data-layout="full" data-count="default"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 to-animate">
                <h3>Kontakt forma</h3>
                <h4><span class="red">*</span> sva polja su obavezna</h4>
                {{ Form::open(['url' => route('contactPOST'), 'role' => 'form', 'id' => 'contact-form']) }}
                    <div class="form-group">
                        {{ Form::label('full_name', 'Ime i prezime', ['class' => 'sr-only']) }}
                        {{ Form::text('full_name', null, ['class' => 'form-control', 'placeholder' => 'Vaše ime i prezime', 'id' => 'full_name', 'required' => 'true']) }}
                    </div>
                    <div class="form-group">
                       {{ Form::label('email', 'E-mail adresa', ['class' => 'sr-only']) }}
                       {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail adresa', 'id' => 'email', 'required' => 'true']) }}
                    </div>
                    <hr>
                    <div class="form-group">
                        {{ Form::label('subject', 'Naslov poruke', ['class' => 'sr-only']) }}
                        {{ Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Naslov poruke', 'id' => 'subject', 'required' => 'true']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('message_body', 'Tekst poruke', ['class' => 'sr-only']) }}
                        {{ Form::textarea('message_body', null, ['class' => 'form-control', 'placeholder' => 'Tekst poruke', 'id' => 'message_body', 'required' => 'true']) }}
                    </div>

                    <div class="form-group text-center captcha">
                        {{ Form::captcha() }}
                    </div>

                    <div class="space text-center">
                        <button type="submit" class="btn btn-submit-delete btn-submit-full" id="contactSubmit"><i class="fa fa-paper-plane fa-mid"></i> Pošaljite upit</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>