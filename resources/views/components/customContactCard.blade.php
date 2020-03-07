<div class="row m-0 pt-5 pb-5 ">
    <div class="action-section card round-all-round text-center" data-aos="fade" id="{{$id}}">
          <div class="card-body">
            <h2 class="card-title">{{$title}}</h2>
            <p class="card-text">{{$slot}}</p>
                <div class="card-footer">
                    @if(isset($buttons))
                        @foreach($buttons as $button)
                        <a class="button button-{{$button['type'] ?? 'general'}}" href="{{$button['link']}}">
                            {{ __($button['text']) }}
                        </a>
                        @endforeach
                    @else
                        <a class="button button-secondary" href="/contact">
                            {{ __('Contact us') }}
                        </a>
                    @endif
    </div>
          </div>
    </div>
</div>
