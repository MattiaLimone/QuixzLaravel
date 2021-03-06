@extends('layouts.default')
@section('title', 'Home')

@section('seo')
  <!-- Google / Search Engine Tags -->
  <meta itemprop="name" content="@php echo Config::get('app.name'); @endphp - Home">
  <meta itemprop="description" content="{{ $index->aboutContent }}">
  <meta itemprop="image" content="{{ asset('/assets/image/about/about_middle.png') }}">

  <!-- Facebook Meta Tags -->
  <meta property="og:url" content="https://quixz.eu">
  <meta property="og:type" content="website">
  <meta property="og:title" content="@php echo Config::get('app.name'); @endphp - Home">
  <meta property="og:description" content="{{ $index->aboutContent }}">
  <meta property="og:image" content="{{ asset('/assets/image/about/about_middle.png') }}">

  <!-- Twitter Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="@php echo Config::get('app.name'); @endphp - Home">
  <meta name="twitter:description" content="{{ $index->aboutContent }}">
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

  <div class="background_top">
    <h1>Quixz<span>eSports</span></h1>
  </div>

  <div class="arrow">
    <a class="fas fa-angle-down arrow_button" href="#about"></a>
  </div>

  <div class="about" id="about">
      <img src="assets/image/logo/logo_500.png" alt="Quixz eSports logo">
      <div class="about_text">
        <h1>About Us</h1>
        <p>{{ $index->aboutContent }}</p>
      </div>
  </div>

  <div class="news__section" id="news">
    <h1>Recent News</h1>@if ($role == 'Admin')
    @endif
    <div class="news">
      @php $articleCount = 0 @endphp
      @foreach ($articles as $article)
      @php $articleCount++ @endphp
      @if ($articleCount <= 2)
      <a class="article_list" href=" {{ url('/news', $article->slug) }}">
        <img src="{{ asset('/images/' . $article->image) }}" alt="some dummy text" og:image>
        <h1>{{ $article->title }}</h1>
        <h5>{{ date('d M Y', strtotime($article->created_at)) }}</h5>
        <p class="news__desc">{!! strip_tags(substr($article->body, 0, 100)) !!}...</p>
        <p class="readMore">Read more...</p>
        <hr>
      </a>
        @endif
      @endforeach
    </div>
  </div>

  <div class="teams">

    <h1>Our Teams</h1>

@foreach ($teams as $team)
  @if ($team->active == '1')
    <a class="team" href="/team/{{ $team->slug }}" style="background-image: url({{ asset('images/' . $team->image) }}); background-repeat: no-repeat; background-size: cover;)">
        <h3>{{ $team->name }}</h3>
        <div class="teamTint"></div>
    </a>
  @endif
@endforeach
  </div>

  <div class="teamMatches">
    <div class="upcomingMatches">
      <h1>Upcoming Matches</h1>
      @php $matchCount = 0; @endphp
      @foreach ($matches->sortBy('date') as $match)
        @php
            $matchDate = new DateTime($match['date']);
            $date_now = new DateTime();
        @endphp
        @if ($match->quixzScore == '0' && $match->enemyScore == '0' && $matchCount < 3)
          @php $matchCount ++ @endphp
            <div class="match_body">
                <h1>{{ date('d M Y', strtotime($match->date)) }}    -
                    @if ($match->link == '')
                    @else
                      <a target="_blank" href="{{ $match->link }}" style="color: #F8B52A; text-decoration: none">View</a>
                    @endif
                </h1>
                <a href="/tournaments/{{ $match->tournament->slug }}">{{ $match->tournament->name }}</a>
                  <div class="matchEnemy">
                    <div class="matchEnemy__quixz">
                      <img src="../assets/image/logo/logo_500.png" alt="Quixz eSports logo">
                      <h6>{{ $match->team->name }}</h6>
                    </div>
                    <h3>VS</h3>
                    <div class="matchEnemy__info">
                      <h6>{{ $match->enemy }}</h6>
                      @if ($match->enemyLogo != '')
                        <img src=" {{ asset('/images/' . $match->enemyLogo) }} " alt="Logo of opposing team"></img>
                      @else
                        <img src=" {{ asset('/images/default_team_logo.png') }} " alt="Logo of opposing team"></img>
                      @endif
                    </div>
                  </div>
            </div>
            @endif
      @endforeach
      @if ($matchCount == '0')
        @php $matchCount ++; @endphp
        <h4 style="font-family:'Lato'">No upcoming matches</h4>
      @endif
    </div>

    <div class="recentMatches">
      <h1>Recent Matches</h1>
      @php $matchCount = 0; @endphp
      @foreach ($matches->sortBy('date')->reverse() as $match)
        @php
            $matchDate = new DateTime($match['date']);
            $date_now = new DateTime();
        @endphp
            @if ($match->quixzScore != '0' || $match->enemyScore != '0')
              @if ($matchCount >= 3)
                @continue
              @endif
              @php $matchCount ++ @endphp
              <div class="match_body">
                  <h1>{{ date('d M Y', strtotime($match->date)) }}    -
                      @if ($match->link == '')
                      @else
                        <a target="_blank" href="{{ $match->link }}" style="color: #F8B52A; text-decoration: none">View</a>
                      @endif
                  </h1>
                  <a href="/tournaments/{{ $match->tournament->slug }}">{{ $match->tournament->name }}</a>
                    <div class="matchEnemy">
                      <div class="matchEnemy__quixz">
                        <img src="../assets/image/logo/logo_500.png" alt="Quixz eSports logo">
                        <h6>{{ $match->team->name }}</h6>
                      </div>
                      <div class="matchMiddle">
                        <h3>VS</h3>
                        <h2>{{ $match->quixzScore }} : {{ $match->enemyScore }}</h2>
                      </div>
                      <div class="matchEnemy__info">
                        <h6>{{ $match->enemy }}</h6>
                        @if ($match->enemyLogo != '')
                          <img src=" {{ asset('/images/' . $match->enemyLogo) }} " alt="Logo of opposing team"></img>
                        @else
                          <img src=" {{ asset('/images/default_team_logo.png') }} " alt="Logo of opposing team"></img>
                        @endif
                      </div>
                    </div>
              </div>
            @endif
      @endforeach
    </div>
  </div>

  <div class="upcomingTournaments">
    <div class="title">
      <h1>Tournaments</h1>
      <a href="/tournaments" style="color: #F8B52A; text-decoration: none; font-family: Lato; font-size: .8rem; margin-top: -2rem">View All</a>
    </div>
    @php $tournCount = 0; @endphp
    @foreach ($tournaments->sortBy('date') as $tourn)
      @php
        $tournDate = new DateTime($tourn['date']);
        $date_now = new DateTime();
      @endphp
      @if ($tournCount < 2 && $tourn->finished == '2')
        @php $tournCount ++ @endphp
          <a class="tournamentBody" href="/tournaments/{{ $tourn->slug }}">
            <img src="{{ asset('images/' . $tourn->image) }}" alt="">
            <div class="tournamentInfoLeft">
              <h2>{{ $tourn->name }}</h2>
              <h3>{{ $tourn->team->name }}</h3>
            </div>
            <div class="tournamentInfoRight">
              <h2>{{ date('d M Y', strtotime($tourn->date)) }}</h2>
              <h3>{{ $tourn->getFinished() }}</h3>
            </div>
          </a>
          @continue
      @endif
    @endforeach
    @if ($tournCount == 0)
      @php $tournCount ++ @endphp
      <h4>No ongoing tournaments</h4>
    @endif
  </div>

  </body>
  </html>


@endsection
