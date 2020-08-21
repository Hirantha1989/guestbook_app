<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="{{ url('/css/guest_book.css') }}">

    <title>Guest Book</title>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">Guest Book </span>
</nav>
<br>
<div class="container">
    @if(Session::has('message'))
        <p class="alert alert-success">{{ Session::get('message') }}</p>
    @endif
    <form action="{{ url('/comments/store') }}" name="comments" autocomplete="off" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder=""
                   name="name" autocomplete="off">
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder=""
                   name="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="pwd">Message:</label>
            <textarea id="message" name="message" rows="2" cols="50"
                      class="form-control @error('message') is-invalid @enderror"></textarea>
            @error('message')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <input type="hidden" id="baseUrl" value="{{ url('') }}">
</div>

<br>
<div class="container">
    <h4 class="h4">Guest's Feedback</h4>
    <div class="row">
        <div class="col-md-12 articles-container" style="background-color:#efefef">
            <br>
            @foreach($comments as $comment)
                <h5>{{ $comment->name }}</h5>
                <p>{{ $comment->message }}</p>
                <button type="button" id="btn_{{$comment->id}}" data-name="{{ $comment->name }}"
                        data-message="{{ $comment->message }}" onclick="shareOnFb({{ $comment->id }})"
                        class="inlineBlock _2tga _89n_ _8j9v"><span class="_8f1i"></span>
                    <div class=""><span class="_3jn- inlineBlock _2v7"><span class="_3jn_"></span><span
                                class="_49vg _8a19"><img class="img" style="vertical-align:middle"
                                                         src="https://www.facebook.com/rsrc.php/v3/yr/r/zSKZHMh8mXU.png"
                                                         alt="" width="12" height="12"></span></span><span
                            class="_49vh _2pi7"> Share</span></div>
                </button>
                <hr>
            @endforeach

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="{{ url('/js/guest_book.js') }}"></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

</body>
</html>
