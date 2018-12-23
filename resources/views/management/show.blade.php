@extends('layouts.default')
@section('title'){{ $player->name }}@endsection

@section('seo')
  <!-- Google / Search Engine Tags -->
  <meta itemprop="name" content="@php echo Config::get('app.name'); @endphp - {{ $player->name }}">
  <meta itemprop="description" content="{{ $player->name }} , a part of the management for Quixz eSports! Click if you want to learn more about {{ $player->name }}">
  <meta itemprop="image" content="{{ asset('/assets/image/about/about_middle.png') }}">

  <!-- Facebook Meta Tags -->
  <meta property="og:url" content="https://quixz.eu">
  <meta property="og:type" content="website">
  <meta property="og:title" content="@php echo Config::get('app.name'); @endphp - {{ $player->name }}">
  <meta property="og:description" content="{{ $player->name }} , a part of the management for Quixz eSports! Click if you want to learn more about {{ $player->name }}">
  <meta property="og:image" content="{{ asset('/assets/image/about/about_middle.png') }}">

  <!-- Twitter Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="@php echo Config::get('app.name'); @endphp - {{ $player->name }}">
  <meta name="twitter:description" content="{{ $player->name }} , a part of the management for Quixz eSports! Click if you want to learn more about {{ $player->name }}">
  <meta name="twitter:image" content="{{ asset('/assets/image/about/about_middle.png') }}">

  <!-- Google Strucutred Data -->
  <script type="application/ld+json">
   { "@context": "http://schema.org",
   "@type": "Organization",
   "name": "Quixz eSports",
   "legalName" : "Quixz eSports",
   "url": "https://quixz.eu",
   "logo": "https://quixz.eu/assets/image/logo/logo_2000.png",
   "foundingDate": "2015",
   "founders": [
   {
   "@type": "Person",
   "name": "Tobias Barsnes",
   "name": "Tim Strutzberg"
   }],
   "contactPoint": {
   "@type": "ContactPoint",
   "contactType": "customer support",
   "email": "contact@quixz.eu",
   "telephone": "+47 913 65 195"
   },
   "sameAs": [
   "https://twitter.com/QuixzeSports",
   "https://www.facebook.com/quixzesports",
   "https://www.gamer.no/klubber/quixz-esports/43274/lag/43275",
   "https://www.youtube.com/channel/UChgzQGcnVEn_nqdSfnggkcw"
   ]}
  </script>

@endsection

@section('content')

<div class="player">
  <div class="player__profile">
    <div class="player_image">
      <img src="{{ asset('images/' . $player->image) }}" alt="">
    </div>

  <div class="player_info">
    <div class="player_name">
      <h1>{{ $player->name }}</h1>
      @if ($role == 'Admin')
         <a style="color:#FFF; text-decoration: none" href="/admin/management/{{ $player->id }}/edit" class="matchButton">Edit</a>
      @endif
    </div>

    <div class="player_game">
      <p>Management</p>
    </div>

  <div class="social-media">
    @if ($player->twitch == NULL)
    @else
      <a href="{{ $player->twitch }}" target="_blank"><i class="fab fa-twitch"></i></a>
    @endif

    @if ($player->twitter == NULL)
    @else
      <a href="{{ $player->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
    @endif

    @if ($player->youtube == NULL)
    @else
      <a href="{{ $player->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
    @endif

    @if ($player->steam == NULL)
    @else
      <a href="{{ $player->steam }}" target="_blank"><i class="fab fa-steam"></i></a>
    @endif

    @if ($player->instagram == NULL)
    @else
      <a href="{{ $player->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
    @endif
  </div>
</div>
</div>

  <div class="player__text">
    <h1 class="title">About {{ $player->name }}</h1>

    {!! $player->body !!}
  </div>
</div>

<style>

.matchButton {
  border: 2px solid #F8B52A;
  padding: .2rem .4rem;
  background: #ffffff00;
  -webkit-transition: background ease-in-out 150ms;
  text-decoration: none;
  color: #FFF;
}

.matchButton:hover {
  background: #F8B52A;
  color: #FFF;
  -webkit-transition: background ease-in-out 150ms;
}

.player {
  background-color: #2B63AF;
  min-height: 100vh;
  padding-top: 1rem;
  text-align: center;
  width: 100vw;
  overflow-y: scroll;
}

.player__profile {
  width: 50%;
  height: auto;
  display: grid;
  grid-gap: 1em;
  grid-template-columns: 2fr 4fr;
  grid-template-rows: auto;
  padding: 2rem 0;
  margin: 0 auto;
  text-align: left;
  margin: 1rem 25%;
  background-color: #FFFFFF20;
  box-shadow: 0 0 50px #00000020;
}

.player_info {
  grid-column: 2 / 3;
  grid-row: 1 / 2;
  width: 100%;
  height: 100%
}

.player_image img {
  width: 100%;
  height: auto;
}

.player_name {
  width: 100%
}

.social-media {
  width: 100%;
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  margin: 0 auto;
  text-align: center;
  margin-top: 12%
}

.social-media a {
  color: #FFF;
  text-decoration: none;
  font-size: 2rem;
  grid-column: span 1;
}

.player__text {
  width: 50%;
  margin: 0 auto;
  text-align: left;
  font-family: "Lato"
}

.player__text .title {
  text-align: center;
  font-family: "Raleway"
}

@media screen and (max-width: 650px) {

  .player__profile {
    width: calc(100vw - 2rem);
    height: auto;
    display: grid;
    grid-gap: .5em;
    grid-template-columns: 1fr;
    grid-template-rows: repeat(2, 1fr);
    padding: 2rem 0;
    margin: 0 auto;
    text-align: left;
    margin: 1rem 1rem;
  }

  .social-media {
    width: 100%;
    text-align: center;
  }

  .player__text {
    width: 80%;
  }

  .player_info {
    grid-column: 1 / 2;
    grid-row: 2 / 2;
    padding: 1rem;
    width: calc(100% - 2rem)
  }
}
</style>

@endsection