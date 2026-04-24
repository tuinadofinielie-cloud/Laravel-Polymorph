<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:ital,wght@0,300;0,400;1,300&display=swap');

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0d0d0d;
            --surface: #161616;
            --border: #2a2a2a;
            --accent: #c8f135;
            --text: #f0f0f0;
            --muted: #666;
            --tag-bg: #1e1e1e;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
        }

        header {
            padding: 2rem 3rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1.4rem;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        header h1 span { color: var(--accent); }

        nav a {
            color: var(--muted);
            text-decoration: none;
            margin-left: 2rem;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            transition: color 0.2s;
        }

        nav a:hover { color: var(--text); }

        .section {
            padding: 3rem;
        }

        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            transition: border-color 0.2s, transform 0.2s;
        }

        .card:hover {
            border-color: var(--accent);
            transform: translateY(-3px);
        }

        .card-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }

        .card-img-placeholder {
            width: 100%;
            height: 180px;
            background: var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            font-size: 2rem;
        }

        .card-body {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .card-type {
            font-size: 0.65rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--accent);
            font-weight: 700;
        }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            line-height: 1.3;
        }

        .card-meta {
            font-size: 0.8rem;
            color: var(--muted);
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-top: auto;
        }

        .tag {
            background: var(--tag-bg);
            border: 1px solid var(--border);
            color: var(--muted);
            font-size: 0.7rem;
            padding: 0.2rem 0.6rem;
            border-radius: 99px;
            letter-spacing: 0.03em;
        }

        .card-footer {
            padding: 0.75rem 1.25rem;
            border-top: 1px solid var(--border);
            font-size: 0.75rem;
            color: var(--muted);
            display: flex;
            gap: 1rem;
        }

        .divider {
            height: 1px;
            background: var(--border);
            margin: 0 3rem;
        }
    </style>
</head>
<body>

<header>
    <h1>Plat<span>.</span>forme</h1>
    <nav>
        <a href="#articles">Articles</a>
        <a href="#videos">Vidéos</a>
    </nav>
</header>

<!-- ARTICLES -->
<section class="section" id="articles">
    <p class="section-title">Articles — {{ count($articles) }} publiés</p>
    <div class="grid">
        @foreach ($articles as $article)
            <a class="card" href="{{ route('article.detail', $article->id) }}">
                @if ($article->images->isNotEmpty())
                    <img class="card-img" src="{{ $article->images->first()->chemin }}" alt="{{ $article->images->first()->description }}">
                @else
                    <div class="card-img-placeholder">📄</div>
                @endif
                <div class="card-body">
                    <span class="card-type">Article</span>
                    <p class="card-title">{{ $article->title }}</p>
                    <p class="card-meta">Par {{ $article->author }}</p>
                    <div class="tags">
                        @foreach ($article->tags as $tag)
                            <span class="tag">{{ $tag->libelle }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <span>💬 {{ $article->commentaires->count() }} commentaire(s)</span>
                </div>
            </a>
        @endforeach
    </div>
</section>

<div class="divider"></div>

<!-- VIDEOS -->
<section class="section" id="videos">
    <p class="section-title">Vidéos — {{ count($videos) }} disponibles</p>
    <div class="grid">
        @foreach ($videos as $video)
            <a class="card" href="{{ route('video.detail', $video->id) }}">
                @if ($video->images->isNotEmpty())
                    <img class="card-img" src="{{ $video->images->first()->chemin }}" alt="{{ $video->images->first()->description }}">
                @else
                    <div class="card-img-placeholder">🎬</div>
                @endif
                <div class="card-body">
                    <span class="card-type">Vidéo</span>
                    <p class="card-title">{{ $video->title }}</p>
                    <p class="card-meta">{{ gmdate('H\hi\m', $video->duration) }}</p>
                    <div class="tags">
                        @foreach ($video->tags as $tag)
                            <span class="tag">{{ $tag->libelle }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <span>💬 {{ $video->commentaires->count() }} commentaire(s)</span>
                </div>
            </a>
        @endforeach
    </div>
</section>

</body>
</html>
