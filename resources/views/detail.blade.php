<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->title }}</title>
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
        }

        header h1 span { color: var(--accent); }

        .back {
            color: var(--muted);
            text-decoration: none;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            transition: color 0.2s;
        }

        .back:hover { color: var(--text); }

        .container {
            max-width: 860px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        .type-badge {
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--accent);
            font-weight: 700;
            margin-bottom: 1rem;
            display: block;
        }

        .title {
            font-family: 'Syne', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.03em;
            margin-bottom: 1rem;
        }

        .meta {
            color: var(--muted);
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-bottom: 2rem;
        }

        .tag {
            background: #1e1e1e;
            border: 1px solid var(--border);
            color: var(--muted);
            font-size: 0.7rem;
            padding: 0.2rem 0.6rem;
            border-radius: 99px;
        }

        /* Image */
        .cover {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 2rem;
            border: 1px solid var(--border);
        }

        /* Vidéo YouTube embed */
        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            border: 1px solid var(--border);
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            border: none;
        }

        /* Contenu article */
        .body-content {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #c8c8c8;
            margin-bottom: 3rem;
        }

        /* Commentaires */
        .section-label {
            font-family: 'Syne', sans-serif;
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .comment {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-bottom: 0.75rem;
        }

        .comment-author {
            font-size: 0.75rem;
            color: var(--accent);
            font-weight: 700;
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .comment-body {
            font-size: 0.9rem;
            color: #b0b0b0;
            line-height: 1.6;
        }

        .no-comments {
            color: var(--muted);
            font-size: 0.9rem;
            font-style: italic;
        }
    </style>
</head>
<body>

<header>
    <h1>Plat<span>.</span>forme</h1>
    <a class="back" href="/">← Retour</a>
</header>

<div class="container">

    {{-- Type badge --}}
    @if (isset($item->url))
        <span class="type-badge">🎬 Vidéo</span>
    @else
        <span class="type-badge">📄 Article</span>
    @endif

    <h2 class="title">{{ $item->title }}</h2>

    <p class="meta">
        @if (isset($item->author))
            Par {{ $item->author }} &nbsp;·&nbsp;
        @endif
        @if (isset($item->duration))
            {{ gmdate('H\hi\m', $item->duration) }}
        @endif
    </p>

    {{-- Tags --}}
    @if ($item->tags->isNotEmpty())
        <div class="tags">
            @foreach ($item->tags as $tag)
                <span class="tag">{{ $tag->libelle }}</span>
            @endforeach
        </div>
    @endif

    {{-- Vidéo YouTube --}}
    @if (isset($item->url))
        @php
            preg_match('/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $item->url, $matches);
            $videoId = $matches[1] ?? null;
        @endphp
        @if ($videoId)
            <div class="video-wrapper">
                <iframe src="https://www.youtube.com/embed/{{ $videoId }}" allowfullscreen></iframe>
            </div>
        @endif

    {{-- Image article --}}
    @elseif ($item->images->isNotEmpty())
        <img class="cover" src="{{ $item->images->first()->chemin }}" alt="{{ $item->images->first()->description }}">
    @endif

    {{-- Contenu article --}}
    @if (isset($item->body))
        <div class="body-content">{{ $item->body }}</div>
    @endif

    {{-- Commentaires --}}
    <p class="section-label">Commentaires — {{ $item->commentaires->count() }}</p>

    @forelse ($item->commentaires as $commentaire)
        <div class="comment">
            <p class="comment-author">{{ $commentaire->author }}</p>
            <p class="comment-body">{{ $commentaire->body }}</p>
        </div>
    @empty
        <p class="no-comments">Aucun commentaire pour le moment.</p>
    @endforelse

</div>

</body>
</html>
