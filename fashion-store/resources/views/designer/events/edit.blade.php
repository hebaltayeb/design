@extends('layouts.app')

@section('content')
<div class="container">
    <h1>تعديل الفعالية</h1>

    <form action="{{ route('designer.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label>عنوان الفعالية:</label>
            <input type="text" name="title" value="{{ $event->title }}" required>
        </div>
        <div>
            <label>الوصف:</label>
            <textarea name="description">{{ $event->description }}</textarea>
        </div>
        <div>
            <label>المكان:</label>
            <input type="text" name="location" value="{{ $event->location }}" required>
        </div>
        <div>
            <label>التاريخ:</label>
            <input type="date" name="date" value="{{ $event->date }}" required>
        </div>
        <div>
            <label>الوقت:</label>
            <input type="time" name="time" value="{{ $event->time }}" required>
        </div>
        <div>
            <label>صورة الفعالية:</label>
            @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" style="max-width:100px;">
            @endif
            <input type="file" name="image">
        </div>
        <button type="submit">تحديث</button>
    </form>
</div>
@endsection