@extends('template.master')
@section('content')
    @if(!$user)
        <div class="section no-pad-bot grey darken-4 banner-section" id="index-banner">
            <div class="container">
                <br><br>
                <h1 class="header center  white-text text-darken-3">Every idea on the go!</h1>
                <div class="row center">
                    <a href="#" onclick="login()" class="btn-large waves-effect waves-light blue-grey darken-3">Get started</a>
                </div>
                <br><br>
            </div>
        </div>
    @endif
    <div class="container">
        <div class="section">
            <div class="row">
                @foreach($jots as $key => $jot)
                    <div class="col s12 m4">
                        <div class="card {{ $jot->color }}">
                            <div class="card-content white-text">
                                <span class="card-title">{{ $jot->title ?? 'Untitled' }}</span>
                                <p>{{ substr($jot->content, 0, 140) }}...</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="fixed-action-btn">
            <a class="btn-floating btn-large green modal-trigger" href="#modal1">
                <i class="large material-icons">add</i>
            </a>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <form class="col s12" action="{{ url('/') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="title" type="text" name="title">
                        <label for="title">Title</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="content" name="content" class="materialize-textarea" placeholder="Jot something here." rows="20"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <select name="color">
                            <option value="amber accent-3" selected>Amber</option>
                            <option value="light-blue accent-3">Blue</option>
                            <option value="blue-grey darken-3">Grey</option>
                            <option value="deep-purple darken-3">Purple</option>
                            <option value="teal accent-3">Teal</option>
                        </select>
                        <label>Select color</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="submit" href="#!" class="modal-close waves-effect waves-green btn-flat">Save</submit>
            </div>
        </form>
    </div>
@stop