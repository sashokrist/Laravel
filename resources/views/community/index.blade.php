@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Community</h1>
                <ul class="list-group">
                    @if(count($links))
                    @foreach($links as $link)
                        <li class="list-group-item">
                            <span style="background: {{ $link->channel->color }}; font-weight: bold; margin: 5px; padding: 5px;">{{ $link->channel->title }}</span>
                            <a href="{{ $link->link }}" target="_blank">{{ $link->title }}</a>
                            <small>
                                Created by:{{ $link->creator->name }} {{ $link->updated_at->diffForHumans() }}
                            </small>
                        </li>
                    @endforeach
                        @else
                        No links yet!
                        @endif
                </ul>
            </div>
            @include('community.add-link')
        </div>
    </div>
@endsection

