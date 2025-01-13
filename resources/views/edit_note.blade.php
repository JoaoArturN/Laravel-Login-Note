@extends('layouts.main_layout')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">

                @include('top-bar')

                <!-- label and cancel -->
                <div class="row">
                    <div class="col">
                        <p class="display-6 mb-0">NEW NOTE</p>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('main') }}" class="btn btn-outline-danger">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    </div>
                </div>


                <!-- form -->
                <form action="{{ route('editSubmit') }}" method="post">
                    @csrf

                    <input type="hidden" name="note_id" value="{{ Crypt::encrypt($note->id) }}">
                    <div class="row mt-3">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Edit Title</label>
                                <input type="text" class="form-control bg-primary text-white" name="text_title"
                                    value="{{ $note->title }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Note Text</label>
                                <textarea class="form-control bg-primary text-white" name="text_note" rows="5">{{ $note->text }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col text-end">
                            <a href="{{ route('main') }}" class="btn btn-primary px-5"><i
                                    class="fa-solid fa-ban me-2"></i>Cancel</a>
                            <button type="submit" class="btn btn-secondary px-5"><i
                                    class="fa-regular fa-circle-check me-2"></i>Edit</button>
                        </div>
                    </div>
                </form>


                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
