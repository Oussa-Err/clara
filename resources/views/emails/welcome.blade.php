<h1>
    Hello {{ $user->username }}
</h1>
<div>
    <h2>You created {{ $post->title }}</h2>
    <img width="500" src={{ $message->embed('storage/' . $post->image) }} alt="your blog image">
</div>
