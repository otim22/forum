@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a new thread</div>

                    <div class="panel-body">
                        <form method="POST" action="/threads">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="ttile" name="title">
                            </div>

                            <div class="form-group">
                                <label for="body">Body:</label>
                                <textarea type="body" name="body" id="body" class="form-control" rows="8"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary" >Publish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection