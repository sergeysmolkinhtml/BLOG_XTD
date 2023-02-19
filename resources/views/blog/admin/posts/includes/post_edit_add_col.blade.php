
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary"> Save </button>
            </div>
        </div>
    </div>
</div>
<br>

@if($item->exists)
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li> ID: {{$item->id}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Created
                        <input type="text" value="{{$item->created_at}} " class="form-control" disabled>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="title">Changed
                        <input type="text" value="{{$item->updated_at}}" class="form-control" disabled>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="title">Deleted
                        <input type="text" value="{{$item->published_at}}" class="form-control" disabled>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endif
