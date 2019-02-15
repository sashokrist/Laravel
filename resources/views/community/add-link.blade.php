@if(Auth::check())
<div class="col-md-4">
    <h3>Contribute a link</h3>
    <form method="post" action="/community">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="">Channel:</label>
            <select name="channel_id" class="form-control" id="">
                <option selected disabled>Pick a channel...</option>
               @foreach($channels as $channel)
                    <option value="{{ $channel->id }}">{{ $channel->title }}</option>
                   @endforeach
            </select>
            {!! $errors->first('channel_id', '<span class="form-text">:message</span>') !!}
        </div>
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            <input type="text" class="form-control" name="title" placeholder="Enter the title of article" value="{{ old('title') }}" required>
            {!! $errors->first('title', '<span class="form-text">:message</span>') !!}
        </div>
        <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
            <input type="text" class="form-control" name="link" placeholder="enter link" value="{{ old('link') }}" required>
            {!! $errors->first('link', '<span class="form-text">:message</span>') !!}
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
    @else
    <h2><a href="http://localhost:8000/login">Sign in to contribute a link!</a></h2>
    @endif

