<div class="card" style="width: 18rem; margin-bottom: 20px; background: #fdfbf1!important;">
  <div class="card-body">
    <h5>M - bianca</h5>
    <p class="text-justify"></p>
    <p class="text-justify"></p>
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
<div class="card" style="width: 18rem;">
  <div class="d-flex justify-content-between bg-transparent  card-header">
    <strong>标签</strong>
  </div>
  <div class="p-3 card-body">
    @foreach($tags as $tag)
    <label style="margin-bottom: 15px;"><a href="{{ route('topics.tags') }}?search={{ $tag->tag_name }}" style="margin-right: 10px; background-color: #dbf4db; color: #686565; padding: 5px; border-radius: 5px; text-decoration: none;">{{ $tag->tag_name }}</a></label>
    @endforeach
  </div>
</div>
