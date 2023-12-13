<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IBUPEDIA</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384">
    </head>
    <body style="background: rgb(247, 243, 243)">

    <div class="container mt-5 mb-5">

                <div class="mt-4 p-5 bg-primary text-white rounded">
                    <img src="{{ asset('storage/blog/'.$blog->image) }}"class="w-100 rounded">
                    <hr>
                    <h4>{{ $blog->title }}</h4>
                    <p class="tmt-3">
                        {!! $blog->content !!}
                    </p>
                    <a href="/blog" class="btn btn-dark">Back</a>
</div>
</div>
</body>
</htnl>