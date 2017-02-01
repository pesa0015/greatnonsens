@extends('layouts.app')

@section('content')
    <div id="welcome" class="welcome">
        <h1>Great nonsens</h1>
        <h2>Skriv några ord. Låt en vän fortsätta.</h2>
    </div>
    <div id="content">
        <div id="start">
            <button class="show-modal" data-modal="create-story">
                <span>Skapa en ny story</span>
                <span class="ion-forward"></span>
            </button>
            <button class="show-modal" data-modal="join-story">
                <span>Fortsätt skriv</span>
                <span class="ion-edit"></span>
            </button>
        </div>
    </div>
@endsection
