<iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=290 height=110 src="//music.163.com/outchain/player?type=0&id=2523443199&auto=1&height=90"></iframe>
<div class="card" style="width: 18rem; margin-bottom: 20px; background: #fdfbf1!important;">
  <div class="card-body">
    <h5>文章标签</h5>
    @if (count($topic->arr_tags)>0)
      @foreach($topic->arr_tags as $tag)
        <a href="{{ route('topics.tags') }}?search={{ $tag }}" style="margin-right: 10px; background-color: #dbf4db; color: #686565; padding: 5px; border-radius: 5px; text-decoration: none;">{{ $tag }}</a> 
      @endforeach
    @endif
  </div>
</div>
<div class="card" style="width: 18rem; margin-bottom: 20px;">
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('images/kobe.jpg') }}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/sidebar.jpg') }}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/life.jpg') }}" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <div class="card-body">
    <p class="card-text">Some of life,you have to go to great challenges.</p>
  </div>
  <ul class="list-group list-group-flush" style="align-items: center;">
    <li class="list-group-item">૮꒰ ˶• ༝ •˶꒱ა  记录生活</li>
    <li class="list-group-item"> ૮(˶ᵔ ᵕ ᵔ˶)ა&nbsp;&nbsp;&nbsp;&nbsp;技术分享</li>
  </ul>
</div>
