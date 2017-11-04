            <!-- start fun-facts tab -->
            <div id="fun-facts" class="tab-pane fade">
                {{ Form::open(['url' => route('admin-fun-facts-editPOST'), 'role' => 'form', 'id' => 'admin-fun-facts', 'class' => 'form-element']) }}

                    @foreach($fun_facts_data as $fact)
                        <div class="row well">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="info_title_{{ $fact->id }}">Info {{ $fact->id }}:</label>
                                    <input class="form-input-control" placeholder="Info {{ $fact->id }}" name="info_title_{{ $fact->id }}" type="text" value="{{ $fact->info_title }}">
                                </div>
                            </div>

                             <div class="col-md-3">
                                <div class="form-group">
                                    <label for="info_number_{{ $fact->id }}">Broj {{ $fact->id }}:</label>
                                    <input class="form-input-control" placeholder="Broj {{ $fact->id }}" name="info_number_{{ $fact->id }}" pattern="\d+" type="text" value="{{ $fact->info_number }}">
                                </div>
                             </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="info_icon_{{ $fact->id }}">Ikona {{ $fact->id }}:</label><br>
                                    <select class="selectpicker show-tick use-font-awesome" data-style="btn-submit-delete" title="Ikona..." data-size="5" name="info_icon_{{ $fact->id }}">
                                        <optgroup label="Ikona...">
                                            @foreach($fun_facts_icons as $icon => $name)
                                                <option value="{{ $icon }}" @if($icon == $fact->info_icon) selected="selected" @endif>{{ $name }}</option>
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
            <!-- end fun-facts tab -->