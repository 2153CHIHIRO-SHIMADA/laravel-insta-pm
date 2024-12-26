{{--Clickable image--}}
<div class="container p-0">
    <a href="{{route('post.show', $post->id)}}">
        <img src="{{$post->image}}" alt="post id{{$post->id}}" class="w-100">
    </a>
</div>

<div class="card-body">
    {{--heart button + no. of likes + categproes--}}
    <div class="row align-item-center">
        <div class="col-auto">
            @if($post->isLiked())
            {{--RED HEART--}}
            <form action="{{ route('like.destroy', $post->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm shadow-none p-0">
                    <i class="fa-solid fa-heart text-danger"></i></button>
                </form>
            {{--HOLLOW--}}
            @else
            <form action="{{route('like.store', $post->id)}}" method="post">
                @csrf
                <button type="submit" class="btn btn-sm shadow-none p-0">
                    <i class="fa-regular fa-heart"></i></button>
                </form>
                @endif
        </div>

        <div class="col-auto px-0">
            <span>{{$post->likes->count()}}</span>
        </div>

        <div class="col text-end">
            @foreach($post->categoryPost as $category_post)
              <span class="badge bg-secondary bg-opacity-50">{{$category_post->category->name}}</span>
              @empty
              <div class="badge bg-dark text-wrap">
                Uncategprozed
              </div>
              @endforelse
            </div>
         @endforeach
        </div>
    </div>

    {{--owner + description--}}
    <a href="{{route('profile.show', $post->user->id)}}" class="text-decoration-none text-dark fw-bold">{{$post->user->name}}</a>
    &nbsp;
    <p class="d-inline fw-light">{{$post->description}}</p>
    <p class="text-uppercase text-muted xsmall">{{date('M d,Y', strtotime($post->created_at))}}</p>

    {{--include comments here--}}
    @include('users.posts.contents.comments')

</div>