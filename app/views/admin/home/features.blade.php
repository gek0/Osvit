            <!-- start features tab -->
            <div id="features" class="tab-pane fade">
                {{ Form::open(['url' => route('admin-features-editPOST'), 'role' => 'form', 'id' => 'admin-features', 'class' => 'form-element']) }}

                    @foreach($feature_data as $feature)
                        <div class="row well">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="feature_title_{{ $feature->id }}">Naslov {{ $feature->id }}:</label>
                                    <input class="form-input-control" placeholder="Naslov {{ $feature->id }}" name="feature_title_{{ $feature->id }}" type="text" value="{{ $feature->feature_title }}">
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="feature_body_{{ $feature->id }}">Tekst {{ $feature->id }}:</label>
                                    <input class="form-input-control" placeholder="Tekst {{ $feature->id }}" name="feature_body_{{ $feature->id }}" type="text" value="{{ $feature->feature_body }}">
                                </div>
                             </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="feature_link_{{ $feature->id }}">Link {{ $feature->id }}:</label><br>
                                    <select class="selectpicker show-tick" data-style="btn-submit-delete" title="Link..." data-size="5" name="feature_link_{{ $feature->id }}">
                                        <optgroup label="Link...">
                                            @foreach($feature_links as $link => $name)
                                                <option value="{{ $link }}" @if($link == $feature->feature_link) selected="selected" @endif>{{ $name }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="feature_icon_{{ $feature->id }}">Ikona {{ $feature->id }}:</label><br>
                                    <select class="selectpicker show-tick use-font-awesome" data-style="btn-submit-delete" title="Ikona..." data-size="5" name="feature_icon_{{ $feature->id }}">
                                        <optgroup label="Ikona...">
                                            @foreach($feature_icons as $icon => $name)
                                                <option value="{{ $icon }}" @if($icon == $feature->feature_icon) selected="selected" @endif>{{ $name }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="text-center">
                        <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
                    </div>
                {{ Form::close() }}
            </div>
            <!-- end features tab -->