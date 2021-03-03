<a class="action-section card small round-all-round w-100" data-aos="fade" data-aos-anchor-placement="top-bottom" id="{{$id}}" href="{{$link}}">
      <div class="card-body row p-0 m-0 flex">
        <div class="two columns">
        @if(isset($image))
            <img src="{{$image}}" class="card-img-top p-0" style="max-height: 5rem;object-fit: scale-down;" alt="{{Config('app.name')}}">
        @endif
        </div>
        <div class="nine columns">
            <div class="card-title text-left m-0">{{$title}}</div>
        </div>
        <div class="one columns text-muted u-right-text">
            →
        </div>
      </div>
</a>
