@extends('layouts.app')

@section('content')
<div class="container">
    <h1>إضافة فعالية جديدة</h1>

    <form action="{{ route('designer.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>عنوان الفعالية:</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label>الوصف:</label>
            <textarea name="description"></textarea>
        </div>
        <div>
            <label>المكان:</label>
            <input type="text" name="location" required>
        </div>
        <div>
            <label>التاريخ:</label>
            <input type="date" name="date" required>
        </div>
        <div>
            <label>الوقت:</label>
            <input type="time" name="time" required>
        </div>
        <div>
            <label>صورة الفعالية:</label>
            <input type="file" name="image">
        </div>
        <button type="submit">حفظ</button>
    </form>
</div>
@endsection