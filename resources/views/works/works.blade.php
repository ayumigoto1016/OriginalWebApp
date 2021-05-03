@if (count($works) > 0)
    <ul class="list-unstyled">
        @foreach ($works as $work)
            <li class="media mb-3">
                <div class="media-body">
                        {{-- 作品画像 --}}
                        <img class="mr-4 rounded" src="https://www.tobezoo.com/peace/img/mn04.jpg" alt="">                        
                        {{-- 作品タイトル --}}
                        <p class="mb-0">{!! nl2br(e($work->title)) !!}</p>
                    <div>
                        @if (Auth::id() == $work->user_id)
                            {{-- 作品削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['works.destroy', $work->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $works->links() }}
@endif