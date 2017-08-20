@extends('main')

@section('title', 'Contact Us')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Contact Me</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form method="post" action="{{ route('contact.post') }}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" class="form-control" type="email">
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input id="subject" name="subject" class="form-control" type="subject">
                </div>
                
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" class="form-control" placeholder="Type your message here..."></textarea>
                </div>
                
                <button class="btn btn-success btn-block" type="submit">Send Message</button>
            </form>
        </div>
    </div>
@endsection