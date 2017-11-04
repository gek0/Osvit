            <!-- start about-us tab -->
            <div id="about-us" class="tab-pane fade">
                {{ Form::open(['url' => route('admin-about-us-editPOST'), 'role' => 'form', 'id' => 'admin-about-us', 'class' => 'form-element']) }}

                    <div class="form-group">
                        {{ Form::label('about_title', 'Naslov sekcije:') }}
                        {{ Form::text('about_title', $about_us_data['about_title'], ['class' => 'form-input-control', 'placeholder' => 'Naslov sekcije', 'required' => 'true']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('about_body', 'Tekst sekcije:') }}
                        {{ Form::textarea('about_body', $about_us_data['about_body'], ['class' => 'form-input-control', 'placeholder' => 'O nama', 'id' => 'codeEditor']) }}
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
                    </div>
                {{ Form::close() }}
            </div>
            <!-- end about-us tab -->