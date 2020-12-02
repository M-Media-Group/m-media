<div class="row m-0 pt-3 pb-3 ">
    <a class="action-section card round-all-round text-center p-4" data-aos="fade" id="{{$id}}" href="{{$link}}">
          <div class="card-body row p-0 m-0">
            <div class="col-2 my-auto">
            @if(isset($image))
                <img src="{{$image}}" class="card-img-top p-0" style="max-height: 5rem;object-fit: scale-down;" alt="{{Config('app.name')}}">
            @endif
            </div>
            <div class="col-8 my-auto">
                <div class="card-title text-left m-0">{{$title}}</div>
            </div>
            <div class="col-2 my-auto text-muted">
                →
            </div>
          </div>
    </a>
</div>
