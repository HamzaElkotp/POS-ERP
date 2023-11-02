<div class="modal fade" id="add_new_Modal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModal">إضافه إمتحان</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <form method="POST" action="{{ route("admin.tests.store") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input hidden class="form-control {{ $errors->has('unit_id') ? 'is-invalid' : '' }}" type="text" name="unit_id" id="unit_id" value="{{ $unit->id}}" required>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="required" for="title">{{ trans('cruds.test.fields.title') }}</label>
                                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                                @if($errors->has('title'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.test.fields.title_helper') }}</span>
                            </div>
                
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="time">{{ trans('cruds.test.fields.time') }}</label>
                                <input class="form-control {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="time" value="{{ old('time', '') }}">
                                @if($errors->has('time'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('time') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.test.fields.time_helper') }}</span>
                            </div>
                
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check {{ $errors->has('repeat') ? 'is-invalid' : '' }}">
                                    <input type="hidden" name="repeat" value="0">
                                    <input class="form-check-input" type="checkbox" name="repeat" id="repeat" value="1" {{ old('repeat', 0) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="repeat">{{ trans('cruds.test.fields.repeat') }}</label>
                                </div>
                                @if($errors->has('repeat'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('repeat') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.test.fields.repeat_helper') }}</span>
                            </div>
                
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="description">{{ trans('cruds.test.fields.description') }}</label>
                                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                                @if($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.test.fields.description_helper') }}</span>
                            </div>
    
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="form-check {{ $errors->has('is_published') ? 'is-invalid' : '' }}">
                                    <input type="hidden" name="is_published" value="0">
                                    <input class="form-check-input" type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', 0) == 1 || old('is_published') === null ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_published">{{ trans('cruds.test.fields.is_published') }}</label>
                                </div>
                                @if($errors->has('is_published'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('is_published') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.test.fields.is_published_helper') }}</span>
                            </div>
                
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
