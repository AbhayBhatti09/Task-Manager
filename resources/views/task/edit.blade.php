@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>{{ __('Edit Task') }}</div>
                <a href="{{route('task.index')}}" class="btn btn-primary">Back</a>
            </div>


                <div class="card-body">
                    <form method="POST" action="{{ route('task.update',$task->id) }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-8">
                                <input id="name" name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title',$task->title) }}"  autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label for="description" class="col-md-2 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-8">
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter description">{{old('description',$task->description)}}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="description" class="col-md-2 col-form-label text-md-end">{{ __('Task Status') }}</label>

                            <div class="col-md-8">
                               <select class="form-control" name="status" id="">
                                <option value="pending"{{ old('status', $task->status ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed"{{ old('status', $task->status ?? '') === 'completed' ? 'selected' : '' }}>Completed</option>
                               </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        
                        
                        <div class="row mb-0">
                            <div class="col-md-2 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
