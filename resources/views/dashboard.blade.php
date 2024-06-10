@extends('app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <br>
    <br>
    <br>
    <br><br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br><br>
    <br>
    <br>
    <br>
    <br>
    <div class="row mb-3">
        <div class="col-md-12">
            <h1 class="mb-4">Bienvemido </h1>
            <div class="card bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" style="color: #081527">
                    {{ __("Bienvenido a ATP para ver a tu tenistas preferidos ") }}
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br><br>
<br>
<br>
<br>
<br>
<br>
<br>
<br><br>
<br>
<br>
<br>
<br>


<script>
    setTimeout(function () {
        window.location.href = "{{ route('tenistas.index') }}";
    }, 2000);
</script>
@endsection
