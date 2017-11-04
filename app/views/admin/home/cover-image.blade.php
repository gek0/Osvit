            <!-- start cover-image tab -->
            <div id="cover-image" class="tab-pane fade in active">
                {{ Form::open(['url' => route('admin-cover-editPOST'), 'role' => 'form', 'id' => 'admin-cover-image', 'files' => true, 'class' => 'form-element']) }}
                    <div class="form-group">
                            {{ Form::label('cover_title', 'Naslov:') }}
                            {{ Form::text('cover_title', $cover_data['cover_title'], ['class' => 'form-input-control', 'placeholder' => 'Naslov']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('cover_subtitle', 'Podnaslov:') }}
                        {{ Form::text('cover_subtitle', $cover_data['cover_subtitle'], ['class' => 'form-input-control', 'placeholder' => 'Podnaslov']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('cover_image', 'Postavi sliku naslovnice (briše postojeću):') }}
                        {{ Form::file('cover_image', ['class' => 'file', 'data-show-upload' => false, 'data-show-caption' => true, 'id' => 'cover_image', 'accept' => 'image/*']) }}
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
                    </div>
                {{ Form::close() }}

                <div class="text-center space">
                    <h3>Trenutna slika:</h3>
                    @if($cover_data['cover_file_size'] > 0)
                        {{HTML::image('/'.getenv('COVER_UPLOAD_DIR').'/'.$cover_data['cover_file_name'], getenv('WEB_NAME'), ['title' => $cover_data['cover_file_name'], 'class' => 'img-thumbnail img-responsive'])}}

                        <hr>
                        <a href="{{ route('admin-cover-image-delete') }}" class="space">
                            <button class="btn btn-submit-delete">
                                Obriši <i class="fa fa-trash"></i>
                            </button>
                        </a>
                    @else
                        <p>Trenutno <strong>nema</strong> dodane slike pa je postavljena inicijalna.</p>
                        {{HTML::image($cover_data['cover_file_name'], getenv('WEB_NAME'), ['title' => getenv('WEB_NAME'), 'class' => 'img-thumbnail img-responsive'])}}
                    @endif
                </div>
            </div>
            <!-- end cover-image tab -->