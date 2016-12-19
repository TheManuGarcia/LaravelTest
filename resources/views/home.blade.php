@extends('layouts.master')

@section('content')
    <div class="centered">
        @foreach($actions as $action)
            <a href="{{route('niceaction', ['action' => lcfirst($action->name)]) }}">{{$action-> name}}</a>
        @endforeach

        <br><br>
        @if (count($errors) >0)
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route ('add_action')}}" method="POST">
            <label for="name">Name of action</label>
            <input type="text" name="name"/>
            <label for="niceness">Niceness</label>
            <input type="text" name="niceness"/>
            <button type="submit">Do something!</button>
            {{--Laravel's built-in protection against cross site forgery request--}}
            <input type="hidden" value="{{ Session::token() }}" name="_token">
        </form>
        <br><br>
        <ul>
            {{--Output our logged_actions--}}
            @foreach($logged_actions as $logged_action)
                <li>{{$logged_action->nice_action->name}}</li> {{--we access our table nice_action --}}
            @endforeach
        </ul>
    </div>
@endsection


